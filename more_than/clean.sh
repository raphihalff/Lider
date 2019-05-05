echo "Clean the repository?"
read answer
if [ "$answer" = "Yes" ]
then
	cp unprocessed new_poets new_poems new_poem_links new_bio_links contrib_log readings/* images/* .backups/
	rm unprocessed new_poets new_poems new_poem_links new_bio_links contrib_log readings/* images/*
	cp mysql_script_bk mysql_script
	echo "DONE"
fi
