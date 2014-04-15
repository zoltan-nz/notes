Performance Monitoring in Chrome

In order to properly profile our ember app, we now have a few tools at our disposal.

If we use console.time() and console.timeEnd() in parts of our code that we wish to profile, 
then we can view the exact time taken to complete certain blocks.

For instance, if we want to profile a function:

console.time("foo")
doSomeFooness();
console.timeEnd("foo")

We can see the execution time for that function by opening up a new tab in chrome and going to: chrome://tracing

If we would like to see the per process memory usage for chrome, we can go to: chrome://memory

If we need more granular performance timestamps, we can use: window.performance.now()


Chrome Remote Debugging

If we would like to remotely debug an application, then chrome remote debugging is the tool:

From the machine running chrome:

open /Applications/Google\ Chrome.app --args --remote-debugging-port=9222
ssh -L 0.0.0.0:9223:localhost:9222 -N 127.0.0.1

From the client: 

http://<<ip>>:9223/


Ember Specific Performance Enhancements

There are a number of ways we can improve our apps performance.
Some are easy enough mods, and others are more long term investments.

Some of the easy mods:

replace keypads with jquery
  - replace with didInsertElement and put event handlers on each key
  - markup for keys should now be in the template itself
use ember list view for receipt items: http://emberjs.com/list-view/
try to load data directly into indexedDB rather than going through ember at the initial download
only render views as they are needed

The longer term mods

Note: We can create a new branch to test out these

update to latest ember
update to latest ember-data
ember model to replace ember data


Other Useful Ember Utilities

We need to get the website source for our current ember version RC1

We now have some code to allow us to see exactly what the ember run loop is actually doing, 
including the number of runs we are currently on, and also the time taken to complete a run loop.

The code can be found here: http://jsbin.com/uBiYELO/14/edit

We can use pubsub to update progress bar for initial api download https://github.com/GavinJoyce/ember-beats/blob/master/app/models/pubsub.js

We should also take a look at the firebug console API for some additional helpful tools: http://getfirebug.com/wiki/index.php/Console_API
