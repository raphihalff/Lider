# This Python file uses the following encoding: utf-8
# Copyright (C) 2017-present,  Raphael Halff

# This program is free software: you can redistribute it and/or modify
# it under the terms of the GNU Affero General Public License as published
# by the Free Software Foundation, either version 3 of the License, or
# (at your option) any later version.

# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU Affero General Public License for more details.

# This source code is licensed under the license found in the 
# LICENSE file in the root directory of this source tree, 
# but you can also find it here: <http://www.gnu.org/licenses/>.

from nltk.corpus import BracketParseCorpusReader as c_reader
import nltk
import os
import string
import pickle
import mysql.connector
import sys
import codecs 

from bokeh.io import show, output_file, output_notebook
from bokeh.plotting import figure, output_file, show, ColumnDataSource
from bokeh.models import HoverTool
from bokeh.palettes import Set2, Category20c
from bokeh.layouts import row, column, layout
from bokeh.plotting import figure
from bokeh.resources import CDN, INLINE
from bokeh.embed import file_html
from bokeh.transform import dodge, jitter

from math import pi
from jinja2 import Template

f = open('/home/xn7dbl5/config/mysql.p', 'rb')
config = pickle.load(f)
f.close()

def make_collections():
  # make connection, format query    
  cnx = mysql.connector.connect(**config)
  cursor = cnx.cursor()
  query = "SELECT poem, title_y, title_e, poet, YEAR(date), text_y FROM poem"
  cursor.execute(query)
  db_poems = cursor.fetchall()
  cnx.close()
  
  dates = {}
  poets = {} 
  poems = {}
  
  # group by date and poet
  for poem in db_poems:
    poems[poem[0]] = poem
    if poem[4] in dates:
        dates[poem[4]].append(poem[0])
    else:
        dates[poem[4]] = [poem[0]]
    if poem[3] in poets:
        poets[poem[3]].append(poem[0])
    else:
        poets[poem[3]] = [poem[0]]
  return [dates, poets, poems]


collections = make_collections()
# key is date (year only) and value is list of poem codes
dates = collections[0]
# key is poet and value is a list of poem codes
poets = collections[1]
# key is poem code and value is a list: poet_eng, poet_yid, title_eng, title_yid, date 
poems = collections[2]

#reverse yiddish text to print rtl. ideally check if string needs to be encoded/decoded
def rtl(text):
  t = text
  try:
    t = t.decode('utf8')
  except UnicodeEncodeError:
    pass
  return t[::-1].encode('utf8')

def words(text):
    return nltk.word_tokenize(text)

def w_count(text):
  # num of tokens
  return len(words(text))
  # num of whitespace seperated tokens
  #return len(lider.raw(fileid).split())
  # num of tokens minus single puncutation marks
  '''
  punc = set(w 
           for f in lider.fileids()
           for w in words(f) 
           if len(w) < 2 and 
           not (u'\u05d0' <= w <=u'\u05ea' or u'\u05f0' <= w <=u'\u05e2'))
  puncless_words = words(fileid)
  for p in punc:
  try:
    puncless_words.remove(p)
  except ValueError:
    pass
  return len(puncless_words)
  '''
    
#gets poem code from fileid
def fntocode(fileid):
  return fileid[fileid.index('/') + 1:fileid.index('_poem')]

#gets filename from poem code
def codetofn(code, num):
  i = 0;
  for fileid in lider.fileids():
    if fileid.find(code) != -1:
      if num == True:
        return i
      else:
        return fileid
      i = i + 1
  return -1

#get bar graph size and positioning
def get_dodge(columns):
  col = columns
  width = 1.0 / (col + 1)
  space = 0.2 * width
  width = width - space
  d_odge = width + space
  start = (((width * (col -1)) - (col * space)) * -1) + (space/2.0)
  return dict([('width', width), ('start', start), ('dodge', d_odge)])

# freq all poets by date 
def freqbydate(tokens, normalize):
  # make generic tokens
  if tokens is None:
     tokens = ["דער".decode('utf8'), "װאָס".decode('utf8')]

  # make cfd
  cfd = nltk.ConditionalFreqDist(
    (rtl(target.encode('utf8')).decode('utf8'), poems[poem][4])
    for poem in poems
    for w in words(poems[poem][5])
    for target in tokens
    if w.find(target)!= -1)

  c = [] #token
  d = [] #date
  v = [] #occurences
  p = [] #poem count
  w = [] #word count
  freq = [] #frequency
  
  # collect graph info:
  # date, occurences, poems, words
  for cond in cfd.conditions():
    for date in cfd[cond]:
      wc = 0
      for code in dates[date]:
        wc += w_count(poems[code][5])
      d.append(date)
      v.append(cfd[cond][date])
      p.append(len(dates[date]))
      w.append(wc)
      freq.append((cfd[cond][date]/float(wc))*100)
    d,v,p,w,freq= zip(*sorted(zip(d,v,p,w,freq)))
    c.append([cond,d,v,p,w,freq])
    d,v,p,w,freq = [],[],[],[],[]
  # format graph hover tool
  hover = HoverTool(
      tooltips = [
    ("Date", "@x"),
    ("No. of Poems", "@n_poems"),
    ("Cum. Word Count", "@wc"),
    ("No. Of Occurences", "@count"),
    ("Frequency", "@y{0.00}%")
      ],
      formatters = {
        'Date' : 'datetime'
      })
  
  p = figure(plot_height=250, title="Word Frequency: All Poems By Year" + (' (normalized)' if normalize else ''), 
        tools="pan,wheel_zoom,box_zoom,save,reset", 
        active_scroll="wheel_zoom")
  p.add_tools(hover)
  p.xaxis.axis_label = "Year"
  p.yaxis.axis_label = "Word Frequency"
  for color, line in enumerate(c):
    data=dict(
      x = line[1],
      y = line[5],
      n_poems = line[3],
      wc = line[4],
      count=line[2])
    src = ColumnDataSource(data)
    p.line('x', y = 'y' if normalize else 'count', 
           legend=rtl(line[0]), source=src, line_width=3,
      line_color=Set2[8][color])
    p.circle('x', y = 'y' if normalize else 'count', fill_color="white", size=5, source=src)
  
  return p

def freqbypoets(tokens, normalize):
  # make generic tokens
  if tokens is None:
    tokens = ["דער".decode('utf8'), "װאָס".decode('utf8'), 
             "דאַן".decode('utf8'), "נײן".decode('utf8'),
             "גוט".decode('utf8')]
  
  cfd = nltk.ConditionalFreqDist(
    (rtl(target.encode('utf8')).decode('utf8'), poems[poem][3])
    for poem in poems
    for w in words(poems[poem][5])
    for target in tokens
    if w.find(target)!= -1)
  
  c = [] #token
  n = [] #poet name
  v = [] #occurences
  p = [] #poem count
  w = [] #word count
  freq = [] #normailized value
  names = []
  # collect graph info:
  # poet, occurences, poems, word count
  for cond in cfd.conditions():
    for poet in cfd[cond]:
      wc = 0
      for code in poets[poet]:
        wc += w_count(poems[code][5])
      n.append(poet)
      v.append(cfd[cond][poet])
      p.append(len(poets[poet]))
      w.append(wc)
      freq.append((cfd[cond][poet]/float(wc))*100)
    names = sorted(list(set(names + n)))
    n,v,p,w,freq = zip(*sorted(zip(n,v,p,w,freq)))
    c.append([cond,n,v,p,w,freq])
    n,v,p,w,freq = [],[],[],[],[]
  
  # format graph hover tool
  hover = HoverTool(
      tooltips = [
    ("Poet", "@x"),
    ("No. of Poems", "@n_poems"),
    ("Cum. Word Count", "@wc"),
    ("No. Of Occurences", "@count"),
    ("Frequency", "@y{0.00}%")
      ],
      mode='vline')
    
  #Bar graph
  p = figure(x_range=names, plot_height=350, title="Word Frequency: All Poems By Poet" + (' (normalized)' if normalize else ''), 
        tools="pan,wheel_zoom,box_zoom,save,reset", 
        active_scroll="wheel_zoom")
  p.add_tools(hover)
  p.xaxis.axis_label = "Poet"
  p.yaxis.axis_label = "Word Frequency"
  p.xaxis.major_label_orientation = pi/4
  p.x_range.range_padding = 0.1
  
  doj = get_dodge(len(c))

  for color, line in enumerate(c):
    data=dict(
      x = line[1],
      y = line[5],
      n_poems = line[3],
      wc = line[4],
      count = line[2])
    src = ColumnDataSource(data)
    p.vbar(x=dodge('x', doj['start'], range=p.x_range), 
           top = 'y' if normalize else 'count', 
           legend=rtl(line[0]), source=src, width=doj['width'],
      color=Set2[8][color])
    doj['start'] += doj['dodge']
  #Line graph
  '''
  p = figure(x_range=names, plot_height=350, title="All Poems By Year", 
        tools="pan,wheel_zoom,box_zoom,save,reset", 
        active_scroll="wheel_zoom")
  p.add_tools(hover)
  p.xaxis.axis_label = "Poet"
  p.yaxis.axis_label = "Word Frequency"
  p.xaxis.major_label_orientation = pi/4
  for color, line in enumerate(c):
    data=dict(
      x = line[1],
      y = line[2],
      n_poems = line[3],
      wc = line[4])
    src = ColumnDataSource(data)
    p.line('x', 'y', legend=rtl(line[0]), source=src, line_width=3,
      line_color=Set2[8][color])
    p.circle('x', 'y', fill_color="white", size=5, source=src)
    '''
  
  return p


def freqbypoet(poem_code, tokens, normalize):
  # make generic tokens
  if tokens is None:
    tokens = ["דער".decode('utf8'), "װאָס".decode('utf8'), 
             "דאַן".decode('utf8')]
  
  #get poet from poem num
  t_poet = poems[poem_code][3]

  #ite through all poems by poet
  cfd = nltk.ConditionalFreqDist(
    (rtl(target.encode('utf8')).decode('utf8'), p_code)
    for p_code in poets[t_poet]
    for w in words(poems[p_code][5])
    for target in tokens
    if w.find(target)!= -1)
  
  c = [] #token
  n = [] #poem title
  v = [] #occurences
  w = [] #word count
  d = [] #date of poem
  freq = [] #normailized value
  titles = []
  wc_avg = 0
  # collect graph info:
  # poet, occurences, poems, word count
  for cond in cfd.conditions():
    for p_code in cfd[cond]:
      wc = w_count(poems[p_code][5])
      n.append(poems[p_code][2])
      d.append(poems[p_code][4])
      v.append(cfd[cond][p_code])
      w.append(wc)
      wc_avg += wc
      freq.append((cfd[cond][p_code]/float(wc))*100)      

    titles = sorted(list(set(titles + n)))
    n,d,v,w,freq = zip(*sorted(zip(n,d,v,w,freq)))
    c.append([cond,n,d,v,w,freq])
    n,d,v,w,freq = [],[],[],[],[]
    
  wc_avg = wc_avg/len(poets[t_poet])
  # format graph hover tool
  hover = HoverTool(
      tooltips = [
    ("Title", "@x"),
    ("Date", "@date"),
    ("Avg. Word Count", str(wc_avg)),
    ("Word Count", "@wc"),
    ("No. Of Occurences", "@count"),
    ("Frequency", "@y{0.00}%")
      ],
      mode='vline')
  
  #Bar graph
  p = figure(x_range=titles, plot_height=350, title="Word Frequency: Poems of " + t_poet + (' (normalized)' if normalize else ''), 
        tools="pan,wheel_zoom,box_zoom,save,reset", 
        active_scroll="wheel_zoom")
  p.add_tools(hover)
  p.xaxis.axis_label = "Poem"
  p.yaxis.axis_label = "Word Frequency"
  p.xaxis.major_label_orientation = pi/4
  p.x_range.range_padding = 0.1
  
  doj = get_dodge(len(c))

  for color, line in enumerate(c):
    data=dict(
      x = line[1],
      y = line[5],
      date = line[2],
      wc = line[4],
      count = line[3])
    src = ColumnDataSource(data)
    p.vbar(x=dodge('x', doj['start'], range=p.x_range), 
           top = 'y' if normalize else 'count', 
           legend=rtl(line[0]), source=src, width=doj['width'],
      color=Set2[8][color])
    doj['start'] += doj['dodge']
      
  return p

def freqbypoetbydate(poem_code, tokens, normalize):
  # make generic tokens
  if tokens is None:
    tokens = ["אַ".decode('utf8'), "און".decode('utf8'), 
             "דו".decode('utf8')]
  
  #get poet from poem num
  t_poet = poems[poem_code][3]
  
  #ite through all poems by poet
  cfd = nltk.ConditionalFreqDist(
    (rtl(target.encode('utf8')).decode('utf8'), poems[p_code][4])
    for p_code in  poets[t_poet]
    for w in words(poems[p_code][5])
    for target in tokens
    if w.find(target)!= -1)
  
  date_tally = {}
  for p in poets[t_poet]:
    if poems[p][4] in date_tally:
      date_tally[poems[p][4]] += 1
    else:
      date_tally[poems[p][4]] = 1
        

  c = [] #token
  d = [] #date
  v = [] #occurences
  p = [] #poem count
  w = [] #word count
  freq = [] #frequency 
  # collect graph info:
  # date, occurences, poems, words
  for cond in cfd.conditions():
    for date in cfd[cond]:
      wc = 0
      for f in dates[date]:
        if f in poets[t_poet]:
          wc += w_count(poems[f][5])
      d.append(date)
      v.append(cfd[cond][date])
      p.append(date_tally[date])
      w.append(wc)
      freq.append((cfd[cond][date]/float(wc))*100)
    d,v,p,w,freq= zip(*sorted(zip(d,v,p,w,freq)))
    c.append([cond,d,v,p,w,freq])
    d,v,p,w,freq = [],[],[],[],[]
  
  # format graph hover tool
  hover = HoverTool(
      tooltips = [
    ("Date", "@x"),
    ("No. of Poems", "@n_poems"),
    ("Cum. Word Count", "@wc"),
    ("No. Of Occurences", "@count"),
    ("Frequency", "@y{0.00}%")
      ],
      formatters = {
        'Date' : 'datetime'
      })
  
  p = figure(plot_height=250, title="Word Frequency: All Poems By Year, By " + t_poet + (' (normalized)' if normalize else ''), 
        tools="pan,wheel_zoom,box_zoom,save,reset", 
        active_scroll="wheel_zoom")
  p.add_tools(hover)
  p.xaxis.axis_label = "Year"
  p.yaxis.axis_label = "Word Frequency"
  for color, line in enumerate(c):
    data=dict(
      x = line[1],
      y = line[5],
      n_poems = line[3],
      wc = line[4],
      count=line[2])
    src = ColumnDataSource(data)
    p.line('x', y = 'y' if normalize else 'count', 
           legend=rtl(line[0]), source=src, line_width=3,
      line_color=Set2[8][color])
    p.circle('x', y = 'y' if normalize else 'count', fill_color="white", size=5, source=src)
  
  return p

def freqinpoem(poem_code, tokens):
  if tokens is None:
    tokens = ["אַ".decode('utf8')]
  
  words_v = tokens  
  text = words(poems[poem_code][5])
  title = poems[poem_code][1]
  
   # make connection, format query    
  cnx = mysql.connector.connect(**config)
  cursor = cnx.cursor()
  query = "SELECT name_y FROM poet WHERE name_e=\"" + poems[poem_code][3] + "\""
  cursor.execute(query)
  db_poet = cursor.fetchall()
  cnx.close()
  
  poet =  db_poet[0][0]
  x = []
  y = []
  con = []
  for x_pos in range(len(text)):
    for y_pos in range(len(words_v)):
      if text[x_pos] == words_v[y_pos]:
        x.append(x_pos)
        y.append(words_v[y_pos])
        line = "..."
        for w in text[x_pos-3:x_pos+4]:
          line += w + " "
        line += "..."
        con.append(line)
       
  hover = HoverTool(
      tooltips = [
    ("Offset", "@x" + "/" + str(len(text))),
    ("Word", "@y"),
    ("Context", "@con")
      ])
    
        
  data=dict(
      x = x,
      y = y,
      con = con)
  src = ColumnDataSource(data)    
  
  p = figure(plot_height=400, y_range=words_v,
             title="Dispersion for :" + title + " פֿון ".decode('utf8') + poet,
              tools="pan,wheel_zoom,box_zoom,save,reset", 
              active_scroll="wheel_zoom")
  p.add_tools(hover)
  p.xaxis.axis_label = "Word Offset"
  p.yaxis.axis_label = "Search Word"
  p.x_range.range_padding = 0
  p.ygrid.grid_line_color = None
  p.circle(x='x', y=jitter('y', width=0.6, range=p.y_range),source=src, alpha=0.6, size=6, fill_color=Set2[8][0])
  
  return p

def main():
  if (len(sys.argv) > 3): 
    out = sys.argv[1]
    selector = int(sys.argv[2])
    tokens = []
    #template_file = open("graph.html", "r")
    temp_text = ""
    with codecs.open("graph.html",'r',encoding='utf8') as f:
      temp_text = f.read()
    template = Template(temp_text)
  
    for i in range(3, len(sys.argv)):
      tokens.append(sys.argv[i].decode('utf8'))
    

    
    # by date
    if (selector == 0):
      with codecs.open(out, 'w', encoding='utf8') as f:
        f.write( file_html([freqbydate(tokens,True),freqbydate(tokens,False)], 
                     INLINE, template=template).decode('utf8'))
    # by poet
    elif (selector == 1):
      with codecs.open(out, 'w', encoding='utf8') as f:
        f.write( file_html([freqbypoets(tokens,True),freqbypoets(tokens,False)],
                     INLINE, template=template).decode('utf8'))
    # in this poem
    elif (selector == 2):
      with codecs.open(out, 'w', encoding='utf8') as f:
        f.write( file_html(freqinpoem(tokens[0], tokens[1:]), 
                     INLINE, template=template).decode('utf8'))
    # by poem
    elif (selector == 3):
      with codecs.open(out, 'w', encoding='utf8') as f:
        f.write( file_html([freqbypoet(tokens[0], tokens[1:], True),
                 freqbypoet(tokens[0], tokens[1:], False)], 
                     INLINE, template=template).decode('utf8'))
    # by poet-date
    elif (selector == 4):
      with codecs.open(out, 'w', encoding='utf8') as f:
        f.write( file_html([freqbypoetbydate(tokens[0], tokens[1:], True),
             freqbypoetbydate(tokens[0], tokens[1:], False)], 
                     INLINE, template=template).decode('utf8'))
    else: 
      return -2
      
    print 0
    return 0
  else: 
    return -1
if __name__ == "__main__":
  main()
