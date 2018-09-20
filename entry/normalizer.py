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
  
import sys
import re
import os
#TODO: 
#   list of spelling variations
#   spelling rules
if (len(sys.argv) == 2):
    file_name = sys.argv[1]
    file_in = file_name
    file_out = "norm_" + file_name 

    f_in = open(file_in, "r")
    f_out = open(file_out, "w")

    #
    for line in f_in:
        line = line.decode("utf8")
        # וו-> װ  
        line = line.replace(u"\u05d5\u05d5", u"\u05f0")
        # יו-> ױ 
        line = line.replace(u"\u05d5\u05d9", u"\u05f1")
        # יי-> ײ
        line = line.replace(u"\u05d9\u05d9", u"\u05f2")
        
        # sofits
        #TODO: check if punctuation follows non-sofit
        #      check fehs without pintl or bar 
        #      full punctuation list

        punc = [u" ",u"\n",u",",u".",u";",u"-",u"\u05be",u":"]
        # feh
        for p in punc:
            line = line.replace(u"\u05e4" + p, u"\u05e3" + p)
        # tsadi
        for p in punc:
            line = line.replace(u"\u05e6" + p, u"\u05e5" + p)
        # khof
        for p in punc:
            line = line.replace(u"\u05db" + p, u"\u05da" + p)
        # nun
        for p in punc:
            line = line.replace(u"\u05e0" + p, u"\u05df" + p)
        # mem
        for p in punc:
            line = line.replace(u"\u05de" + p, u"\u05dd" + p)

        line = line.replace("-", u"\u05be")
        line = line.replace("'", u"\u05f3")

        #pasekhing of the alephs
        line = re.sub(u'\u05d0(?!(\u05c7|\u05b7|\u05b8|\u05d9|\u05f2|\u05d5|\u05f1))', u'\u05d0\u05b7', line)
        #rafeing the fehs
        line = re.sub(u'\u05e4(?!(\u05bf|\u05bc))', u'\u05e4\u05bf', line)
        
        f_out.write(line.encode("utf8"))

    f_in.close()
    f_out.close()

    os.rename(file_name, ".norm_backups/og_" + file_name)
    os.rename("norm_" + file_name, file_name)
else: 
    print "No file specified"


