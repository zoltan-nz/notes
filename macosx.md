### Open a new tab on Terminal with the current working dir

Copy this in ~/.profile:

    # open a new tab on Terminal with the current working dir
    function newtab {
    	osascript -e "
    		tell application \"System Events\" to tell process \"Terminal\" to keystroke \"t\" using command down
    		tell application \"Terminal\" to do script \"cd \\\"$(PWD)\\\"\" in selected tab of the front window
    	" > /dev/null 2>&1
    }
