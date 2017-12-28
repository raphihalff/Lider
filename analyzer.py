# This Python file uses the following encoding: utf-8
from nltk.corpus import BracketParseCorpusReader as c_reader
import nltk
import os


def words(fileid, lider):
    return nltk.word_tokenize(lider.raw(fileid))

# key is date (year only) and value is list of poem codes
dates = {}
# key is poet and value is a list of poem codes
poets = {}
# key is poem code and value is a list: poet_eng, poet_yid, title_eng, title_yid, date 
poems = {}

lider_list = {}
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

cor_root = r"./"
file_pattern = r".*/.*_poem_yid.txt"
lider = c_reader(cor_root, file_pattern)
print lider.raw(lider.fileids()[0])
print lider.fileids()[0]
for token in words(lider.fileids()[0], lider):
    print token
cfd = nltk.ConditionalFreqDist(
        (target, poems[fileid[fileid.index('/') + 1:fileid.index('_poem')]][4])
        for fileid in lider.fileids()
        for w in words(fileid,lider)
        for target in ['האָניק'.decode('utf8'),'שװאַרצ'.decode('utf8')]
        if w.find(target)!= -1)
cfd.plot()
for fileid in lider.fileids():
    for w in words(fileid,lider):
        for target in ['האָניק'.decode('utf8'),'שװאַרצ'.decode('utf8')]:
            if w.find(target) != -1:
                print target
                print w
                print fileid
