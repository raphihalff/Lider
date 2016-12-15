# This Python file uses the following encoding: utf-8
# This reads all poem data and formats it into html page format
import os

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

eng_poem_links = ''
yid_poem_links = ''

#going through subdirectories of current dir, which should contain poet directories
for poet in next(os.walk('.'))[1]:
    if poet != '.git':
        poets.append(poet)

        # parse the .lider file containing basic info on poet and poem collection
        lider_file = open(poet + '/.lider', 'r')
        poet_yid = lider_file.readline().strip()
        while (lider_file.readline() == '\n'):
            title_eng  = lider_file.readline().strip()
            title_yid  = lider_file.readline().strip()
            code = lider_file.readline().strip()
            date = lider_file.readline().strip()
            poems.append(Poem(poet, poet_yid, title_eng, title_yid, code, date))
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
    poem_page.context_img_fn = './' + poem.poet_eng + '/' + poem.code + '_conimg.jpg'
    poem_page.poet_img_fn = './' + poem.poet_eng + '/' + poem.code + '_poetimg.jpg'
   
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

    poem_link_format = '<li><a class="poem_link" href="{0}">{1}</a></li>'
    yid_poem_links += poem_link_format.format(new_p_name, poem_page.title_yid + ' <em>פֿון</em> ' + poem_page.poet_yid)
    eng_poem_links += poem_link_format.format(new_p_name, poem_page.title_eng + ' <em>by</em> ' + poem_page.poet_eng)

# print the browse page
browse_format_f = open('browse_format', 'r')
browse_format = browse_format_f.read()
browse_format_f.close()
browse_page = browse_format.format(yid_poem_links, eng_poem_links)
browse_f = open('index.html','w')
browse_f.write(browse_page)
browse_f.close()


