# This Python file uses the following encoding: utf-8
from nltk.corpus import BracketParseCorpusReader as c_reader
import nltk
import os
import matplotlib.pyplot as plt, mpld3
import pandas as pd
from bokeh.io import show, output_file, output_notebook
from bokeh.plotting import figure

#overwrite matplotlibs show with html version
#plt.show = mpld3.show
plt.xticks(rotation=10)

#initializing the corpus
cor_root = r"./"
file_pattern = r".*/.*_poem_yid.txt"
lider = c_reader(cor_root, file_pattern)

#makes disctionaries by date, poet, and poem
def make_collections():
	dates = {}
	poets = {}
	poems = {}
	for poet in next(os.walk('.'))[1]:
	    if poet != ".git":
		with open(poet + '/.lider', 'r') as dot_lider:
		    poet_yid = dot_lider.readline().strip()
		    count = int(dot_lider.readline().strip())
		    while (dot_lider.readline() == '\n'):
			title_eng = dot_lider.readline().strip()
			title_yid = dot_lider.readline().strip()
			code = dot_lider.readline().strip()
			date = dot_lider.readline().strip()[-4:]
			poems[code] = [poet, poet_yid, title_eng, title_yid, date]
			if date in dates:
			    dates[date].append(code)
			else:
			    dates[date] = [code]
			if poet in poets:
			    poets[poet].append(code)
			else:
			    poets[poet] = [code]
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
	return text.decode('utf8')[::-1].encode('utf8')

def words(fileid):
    return nltk.word_tokenize(lider.raw(fileid))

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

# freq all poets by date 
def freqbydate(tokens):
	plt.subplots_adjust(bottom=0.25)
	cfd = nltk.ConditionalFreqDist(
		(rtl(target.encode('utf8')).decode('utf8'), poems[fntocode(fileid)][4] + " ({:d})".format(len(dates[poems[fntocode(fileid)][4]])))
		for fileid in lider.fileids()
		for w in words(fileid)
		for target in tokens
		if w.find(target)!= -1)
	locx, xticks = plt.xticks()
	locy, yticks = plt.yticks()
	for x in xticks:
		print x.get_text()
	for y in yticks:
		print y.get_text()
	
	print "conditions"
	d_var = [] 
	c_var = []
	for c in cfd.conditions():
		print "condition"
		print c
		print cfd[c]
		for date in cfd[c]:
			print date
			d_var.append(date)
			c_var.append(cfd[c][date])
			print "val " + str(cfd[c][date])
	#cfd.plot()
	con = cfd.conditions()[0]

	print d_var
	print c_var

	output_file("this.html")
	"""
	#p = bk.figure(x_axis_type="datetime")
	p = figure(x_range=d_var, plot_height=250, title="Test", toolbar_location=None, tools="")
	p.vbar(x=d_var, top=c_var, width=0.5)
	p.xgrid.grid_line_color = None
	p.y_range.start = 0
	#p.line(d_var, c_var)
	show(p)
	"""
	fruits = ['Apples()', 'Pears', 'Nectarines', 'Plums', 'Grapes', 'Strawberries']

	p = figure(x_range=d_var, plot_height=250, title="All Poems By Year")

	p.line(x=d_var, y=c_var)

	p.xgrid.grid_line_color = None
	p.y_range.start = 0

	show(p)


def freqbypoets(tokens):
	plt.gcf().subplots_adjust(bottom=0.25)
	cfd = nltk.ConditionalFreqDist(
		(rtl(target.encode('utf8')).decode('utf8'), poems[fntocode(fileid)][0] + " ({:d})".format(len(poets[poems[fntocode(fileid)][0]])))
		for fileid in lider.fileids()
		for w in words(fileid)
		for target in tokens
		if w.find(target)!= -1)
	cfd.plot()

def freqinpoem(poem_num, tokens):
	plt.gcf().subplots_adjust(bottom=0.25)
	nltk.draw.dispersion.dispersion_plot(words(lider.fileids()[poem_num]),tokens)

def freqbypoet(poem_num, tokens):
	plt.gcf().subplots_adjust(bottom=0.25)
	#get poet from poem num
	t_poet = poems[fntocode(lider.fileids()[poem_num])][0]

	#ite through all poems by poet
	cfd = nltk.ConditionalFreqDist(
		(rtl(target.encode('utf8')).decode('utf8'), poems[p_code][2])
		for p_code in poets[t_poet]
		for w in words(codetofn(p_code, False))
		for target in tokens
		if w.find(target)!= -1)
	cfd.plot(title="Usage by " + t_poet)

def freqbypoetbydate(poem_num, tokens):
	plt.gcf().subplots_adjust(bottom=0.25)
	return null

#function to remove diacritics and deal with punctuation, parsing and disambiguating
def diac_rm(text):
	return null

#function to provide alternate search terms from spelling alternatives
def get_syn(text):
	return null

def main_loop():
	# print poem options
	count = 1
	for fn in lider.fileids():
		print str(count) + ") " + poems[fntocode(fn)][2]
		count += 1
	l_align = '{:^130}'
	#prompt user
	print '{:*^100}'.format('')
	poem_num = input("Select a poem: ") - 1
	if poem_num >= count - 1:
		return -1;
	poem = lider.fileids()[poem_num]

	# print poem and tokens
	print '{:*^100}'.format('')
	print l_align.format(rtl(poems[fntocode(poem)][3]))
	print l_align.format(rtl("פֿון" + poems[fntocode(poem)][1]))
	print '{:*^100}'.format('')
	print '\n'
	for line in lider.raw(poem).splitlines():
		print l_align.format(rtl(line.strip().encode('utf8')) + '    ***    ')
	print '\n' + l_align.format(poems[fntocode(poem)][4])
	print '{:*^100}'.format('')

	print "The first 20 tokens:"
	count = 1
	t_words = words(poem)
	for word in t_words[:20]:
		print '{:<25}'.format(str(count) + ") " + rtl(word.encode('utf8').strip())),
		if count%2 == 0:
			print 
		count += 1

	functions = [freqbydate,freqbypoets,freqinpoem, freqbypoet,freqbypoetbydate]
	print '{:*^100}'.format('')
	mode = input("Compare usage: \n(1) with all poems by date, \n(2) with all poets, \n(3) within this poem, \n(4) with other poems by this poet, \n(5) with other poems by this poet by date: ")-1
	print '{:*^100}'.format('')
	if mode >= len(functions):
		return -1
	tokens = input("Which token(s) would you like search by? (e.g [1,4,5])")

	t = [t_words[token - 1] for token in tokens]
	if mode == 2 or mode == 3:
		functions[mode](poem_num, t)
	else: 
		functions[mode](t)

	# dispersion plot (in this poem)
	# detect when yiddish should be encode or decode

if __name__ == "__main__":
	while (True):
		main_loop()


