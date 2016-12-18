run: 
	python page_maker.py

.PHONY: clean
	
clean:
	rm -f *.html 
	rm -f */*.html 
