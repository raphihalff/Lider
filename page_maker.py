# This reads all poem data and formats it into html page format
import os

def l_breaker(text):
    text = text.replace('\n', '<br>')
    return text

def p_breaker(text):
    text = '<p>' + text
    text = text.replace('\n','</p><p>')
    text = text + '</p>'
    return text

def gen_link(link, title):
    link_format = '<a href=\"{0}\">{1}</a>'
    return link_format.format(link, title)

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

for poet in next(os.walk('.'))[1]:
    if poet != '.git':
        poets.append(poet)

        lider_file = open(poet + '/.lider', 'r')
        poet_yid = lider_file.readline().strip()
        while (lider_file.readline() == '\n'):
            title_eng  = lider_file.readline().strip()
            title_yid  = lider_file.readline().strip()
            code = lider_file.readline().strip()
            date = lider_file.readline().strip()
            poems.append(Poem(poet, poet_yid, title_eng, title_yid, code, date))
        lider_file.close()

print("Poets:\n")
for poet in poets:
    print (poet + '\n')

print("Poems:\n")
for poem in poems:
    print 'Poet, English: ', poem.poet_eng, \
            '\nPoet, Yiddish: ', poem.poet_yid, \
            '\nPoem, English: ', poem.title_eng, \
            '\nPoem. Yiddish: ', poem.title_yid.decode('utf-8'),\
            '\nCode:          ', poem.code,\
            '\nDate:          ', poem.date
    poem_page = PoemPage(poem.poet_eng, poem.poet_yid, poem.title_eng, poem.title_yid)
    
    # get recording filename
    rec_file = None
    rec_fn = None
    try:
        rec_fn = './' + poem.poet_eng + '/' +  poem.code + '_rec.mp3'
        rec_file = open(rec_fn)
    except IOError:
        rec_fn = './' + poem.poet_eng + '/' + poem.code + '_rec.m4a'
        rec_file = open(rec_fn)
    rec_file.close()
    poem_page.reading_fn = rec_fn

    sup_f = open('./' + poem.poet_eng + '/' + poem.code + '_sup.txt')
    poem_page.translator = sup_f.readline().strip()
    poem_page.reader = sup_f.readline().strip()
    
    context = ''
    stop = False       
    while (stop == False):
        line = sup_f.readline()
        next = ''
        if line == '\n':
            next = sup_f.readline()
            if next == '\n': 
                stop = True
            else:
                context += line + next.strip()
        else:
            context += line.strip()
    poem_page.context = p_breaker(context)
    
    stop = False
    back = ''
    while (stop == False):
        line = sup_f.readline()
        next = ''
        if line == '\n':
            next = sup_f.readline()
            if next == '\n': 
                stop = True
            else:
                back += line + next.strip()
        else:
            back += line.strip()
    poem_page.poet_background = p_breaker(back)
            
    poem_page.context_img_fn = './' + poem.poet_eng + '/' + poem.code + '_conimg.jpg'
    poem_page.poet_img_fn = './' + poem.poet_eng + '/' + poem.code + '_poetimg.jpg'
    
    resources = ''
    while True:
        link = sup_f.readline()
        if link == '\n':
            break
        link = link.strip()
        title = sup_f.readline().strip()
        resources += gen_link(link, title) + '&nbsp'
    poem_page.poet_resources = resources
    resources = ''
    while True:
        link = sup_f.readline()
        if link == '\n':
            break
        link = link.strip()
        title = sup_f.readline().strip()
        resources += gen_link(link, title) + '&nbsp'
    poem_page.poem_resources = resources
    resources = ''
    while True:
        link = sup_f.readline()
        if link == '\n' or link == '':
            break
        link = link.strip()
        title = sup_f.readline().strip()
        resources += gen_link(link, title)+ '&nbsp'
    poem_page.context_resources = resources 
    sup_f.close()
     
    poem_f = open('./' + poem.poet_eng + '/' + poem.code + '_poem_eng.txt')
    poem_page.poem_eng = l_breaker(poem_f.read())
    poem_f.close()
    poem_f = open('./' + poem.poet_eng + '/' + poem.code + '_poem_yid.txt')
    poem_page.poem_yid = l_breaker(poem_f.read())
    poem_f.close()


#    print poem_page

    new_p = open(poem.code + '.html', 'w')
    format_f = open('poem_format', 'r')
    format = format_f.read()
    format_f.close(); 
    p_page = format.format(poem_page.title_eng, poem_page.context_img_fn, poem_page.context, poem_page.reading_fn, poem_page.reader, poem_page.title_eng, poem_page.title_yid, poem_page.poet_eng, poem_page.poet_yid, poem_page.translator, poem_page.poem_eng, poem_page.poem_yid, poem_page.poet_img_fn, poem_page.poet_background, poem_page.poet_resources, poem_page.poem_resources, poem_page.context_resources, poem.date)
    new_p.write(p_page)
    new_p.close()
