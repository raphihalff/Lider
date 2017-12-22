# This Python file uses the following encoding: utf-8
# This reads all poem data and formats it into html page format
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

import os
import fnmatch
import re
from operator import attrgetter

# replace new lines with HTML line breaks
def l_breaker(text):
    text = text.replace('\n', '<br>')
    return text
# replace newline with HTML paragraph breaks
def p_breaker(text):
    text = '<p>' + text
    text = text.replace('\n','</p><p>')
    text = text + '</p>'
    return text
# put a link and link-title in HTML link format
def gen_link(link, title):
    link_format = '<a href=\"{0}\">{1}</a>'
    return link_format.format(link, title)
# put a link and link title and img in the format of the main browse page (a list)
def gen_poem_link(link, title, thumbnail):
    poem_link_format = '<li class="link_list_item"><div class="link_box"><a class="poem_link" href="{0}"><img class="thumb" src="{2}"><h3 class="link_title">{1}</h3></a></div></li>'
    return poem_link_format.format(link, title, thumbnail)
# a year collection
class Year:
    def __init__(self, year, num_of_poems, links_yid, links_eng):
        self.year               = year
        self.num_of_poems       = num_of_poems
        self.links_eng          = links_eng
        self.links_yid          = links_yid
    def __repr__(self):
        return str(self)
    # True for yiddish
    def gen_link(self, year_page):
        year_str = ''
        if self.year == 0:
            year_str = 'NA'
        else:
            year_str = str(self.year)
        return gen_poem_link(year_page, year_str + ' (' + str(self.num_of_poems) + ')', '')

        
# a poet object
class Poet:
    def __init__(self, poet_eng, poet_yid, num_of_poems, links_yid, links_eng):
        self.poet_eng           = poet_eng
        self.poet_yid           = poet_yid
        self.num_of_poems       = num_of_poems
        self.links_eng          = links_eng
        self.links_yid          = links_yid
    def __repr__(self):
        return str(self)
    # True for yiddish
    def gen_link(self, yiddish, poet_page):
        thumb = '';
        for file in os.listdir('./' + self.poet_eng + '/'):
            if fnmatch.fnmatch(file, '*poetimg.*'): 
                thumb = './' + self.poet_eng + '/' + file
        if (yiddish):
            return gen_poem_link(poet_page, self.poet_yid + ' (' + str(self.num_of_poems) + ')', thumb) 
        else:
            return gen_poem_link(poet_page, self.poet_eng + ' (' + str(self.num_of_poems) + ')', thumb)

# a poem object
class Poem:
    def __init__(self, poet_eng, poet_yid, title_eng, title_yid, code, date):
        self.poet_eng   = poet_eng
        self.poet_yid   = poet_yid
        self.title_eng  = title_eng
        self.title_yid  = title_yid
        self.code       = code
        self.date  = date
        if date == '0':
                self.date  = "" 
    def __repr__(self):
        return str(self)
    def __str__(self):
        return 'Poet, English: '+ self.poet_eng + \
                '\nPoet, Yiddish: '+ poem.poet_yid + \
                '\nPoem, English: '+ poem.title_eng + \
                '\nPoem. Yiddish: '+ poem.title_yid + \
                '\nCode:          '+ poem.code + \
                '\nDate:          '+ poem.date

# a poem_page object
class PoemPage:
    def __init__(self, poet_eng, poet_yid, title_eng, title_yid):
        self.reading_fn              = None
        self.reader                  = None

        self.translator              = None

        self.context_img_fn          = None
        self.context                 = None # add html paragraph breaks

        self.poet_background         = None # add paragraph breaks
        self.poet_img_fn             = None

        self.poem_eng                = None # add line breaks
        self.poem_yid                = None

        self.poet_resources          = None # put in html link format
        self.poem_resources          = None
        self.context_resources       = None
        
        self.poet_eng   = poet_eng
        self.poet_yid   = poet_yid
        self.title_eng  = title_eng
        self.title_yid  = title_yid
    def __repr__(self):
        return str(self)
    def __str__(self):
        output = ''
        for property, value in vars(self).iteritems():
            if value != None:
                output +=  value + '\n'
        return output


poets = []
poems = []
years = []

eng_poem_links = ''
yid_poem_links = ''

#going through subdirectories of current dir, which should contain poet directories
for poet in next(os.walk('.'))[1]:
    if poet != '.git':
        # parse the .lider file containing basic info on poet and poem collection
        lider_file = open(poet + '/.lider', 'r')
        poet_yid = lider_file.readline().strip()
        count = int(lider_file.readline().strip());
        links_yid = ''
        links_eng = ''
        while (lider_file.readline() == '\n'):
            title_eng  = lider_file.readline().strip()
            title_yid  = lider_file.readline().strip()
            code = lider_file.readline().strip()
            date = lider_file.readline().strip()
            poems.append(Poem(poet, poet_yid, title_eng, title_yid, code, date))
            links_yid += gen_poem_link('../' + code + '.html', title_yid, './' + code + '_conimg.jpg')
            links_eng += gen_poem_link('../' + code + '.html', title_eng, './' + code + '_conimg.jpg')
        poets.append(Poet(poet, poet_yid, count, links_yid, links_eng))
        lider_file.close()

for poem in poems:
    poem_page = PoemPage(poem.poet_eng, poem.poet_yid, poem.title_eng, poem.title_yid)
    
    # get recording filename
    rec_file = None
    rec_fn = None
    good_rec_fns = ['_rec.mp3', '_rec.m4a'] # list of acceptable audio files
    i = 0;
    while (i < len(good_rec_fns)):
        try:
            rec_fn = './' + poem.poet_eng + '/' +  poem.code + good_rec_fns[i]
            rec_file = open(rec_fn)
            rec_file.close()
        except IOError:
            i += 1
        else:
            i = len(good_rec_fns)
    poem_page.reading_fn = rec_fn

    # parse the file of supplementary information
    sup_f = open('./' + poem.poet_eng + '/' + poem.code + '_sup.txt')
    poem_page.translator = sup_f.readline().strip()
    poem_page.reader = sup_f.readline().strip()
    
    sup_info = ['','']
    for i in range(0,2):
        stop = False       
        while (not stop):
            line = sup_f.readline()
            next = ''
            if line == '\n':
                next = sup_f.readline()
                if next == '\n': 
                    stop = True
                else:
                    sup_info[i] += line + next.strip()
            else:
                sup_info[i] += line.strip()
    poem_page.context = p_breaker(sup_info[0])
    poem_page.poet_background = p_breaker(sup_info[1])
           
    # get img files
    img_path = './' + poem.poet_eng + '/'
    for name in os.listdir('./' + poem.poet_eng):
    	if poem.code + '_conimg' in name:
    		poem_page.context_img_fn = img_path + name
    	elif poem.code + '_poetimg' in name:
    		 poem_page.poet_img_fn = img_path + name
   
    # read and format resource links
    resources = ['','','']
    for i in range(0,3):
        while True:
            link = sup_f.readline()
            if link == '\n' or link == '':
                break
            link = link.strip()
            title = sup_f.readline().strip()
            resources[i] += gen_link(link, title) + '&nbsp'
    poem_page.poet_resources = resources[0]
    poem_page.poem_resources = resources[1]
    poem_page.context_resources = resources[2] 
    sup_f.close()
     
    # get poem text
    poem_f = open('./' + poem.poet_eng + '/' + poem.code + '_poem_eng.txt')
    poem_page.poem_eng = l_breaker(poem_f.read())
    poem_f.close()
    poem_f = open('./' + poem.poet_eng + '/' + poem.code + '_poem_yid.txt')
    poem_page.poem_yid = l_breaker(poem_f.read())
    poem_f.close()

    # print poem_page
    new_p_name = poem.code + '.html'
    new_p = open(new_p_name, 'w')
    
    format_f = open('poem_format', 'r')
    format = format_f.read()
    format_f.close(); 
    p_page = format.format(poem_page.title_eng, poem_page.context_img_fn, \
            poem_page.context, poem_page.reading_fn, poem_page.reader, \
            poem_page.title_eng, poem_page.title_yid, poem_page.poet_eng,\
            poem_page.poet_yid, poem_page.translator, poem_page.poem_eng, \
            poem_page.poem_yid, poem_page.poet_img_fn, poem_page.poet_background,\
            poem_page.poet_resources, poem_page.poem_resources, poem_page.context_resources, poem.date)
    new_p.write(p_page)
    new_p.close()

    yid_poem_links += gen_poem_link(new_p_name, poem_page.title_yid + ' <em style="color: #F9E79F">פֿון</em> ' + poem_page.poet_yid , poem_page.context_img_fn)
    eng_poem_links += gen_poem_link(new_p_name, poem_page.title_eng + ' <em style="color: #F9E79F">by</em> ' + poem_page.poet_eng  , poem_page.context_img_fn)
    # sort by year
    # get numerical date
    date_num = 0
    if poem.date == '':
        date_num = 0
    else:
        date_num = int(re.findall(r"[0-9]{4}", poem.date)[0])

    # check if year is recorded
    seen = False
    years = sorted(years, key=attrgetter('year'))
    for year in years: 
        if date_num == year.year:
            seen = True
            year.links_yid += gen_poem_link(new_p_name, poem_page.title_yid + ' <em>פֿון</em> ' + poem_page.poet_yid, poem_page.context_img_fn)
            year.links_eng += gen_poem_link(new_p_name, poem_page.title_eng + ' <em>by</em> ' + poem_page.poet_eng, poem_page.context_img_fn)
            year.num_of_poems += 1
    if not seen:
        years.append(Year(date_num, 1, gen_poem_link(new_p_name, poem_page.title_yid + ' <em>פֿון</em> ' + poem_page.poet_yid, poem_page.context_img_fn), gen_poem_link(new_p_name, poem_page.title_eng + ' <em>by</em> ' + poem_page.poet_eng, poem_page.context_img_fn)))

# print poet's work page
poet_format_f = open('poet_format', 'r')
poet_format = poet_format_f.read()
poet_format_f.close()

for poet in poets: 
    poet_f = open('./' + poet.poet_eng + '/index.html','w')
    poet_f.write(poet_format.format(poet.poet_eng, poet.poet_yid, poet.links_yid, poet.links_eng))
    poet_f.close()

# print year page
year_format_f = open('year_format', 'r')
year_format = year_format_f.read()
year_format_f.close()

year_links = ''
for year in years:
    year_str = str(year.year)
    if year_str == '0':
        year_str = 'NA'
    year_f = open ('year' + year_str + '.html', 'w')
    year_links += year.gen_link('year' + year_str + '.html')
    year_f.write(year_format.format(year_str, year_str, year.links_yid, year.links_eng))

# print the browse page
browse_format_f = open('browse_format', 'r')
browse_format = browse_format_f.read()
browse_format_f.close()

# get poet links
yid_poet_links = ''
eng_poet_links = ''
for poet in poets:
    yid_poet_links += poet.gen_link(True, './' + poet.poet_eng + '/index.html')
    eng_poet_links += poet.gen_link(False, './' + poet.poet_eng + '/index.html')

browse_page = browse_format.format(yid_poem_links, eng_poem_links, yid_poet_links, eng_poet_links, year_links)
browse_f = open('index.html','w')
browse_f.write(browse_page)
browse_f.close()


#add poet datalist to entryform
p_list = ''
for poet in poets:
	p_list += "<option value=\""+ poet.poet_eng + "\">"

entry_form_format = open('entry_form_format','r')
entry_form = entry_form_format.read()
entry_form_format.close()
entry_form_page = entry_form.format(p_list)
entry_form_f = open('entry_form.html', 'w')
entry_form_f.write(entry_form_page)
entry_form_f.close()

