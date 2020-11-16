/**
 * First, we will load all of this project's Javascript utilities and other
 * dependencies. Then, we will be ready to develop a robust and powerful
 * application frontend using useful Laravel and JavaScript libraries.
 */

require('./bootstrap')
require('./components/__components')
//Human readable dates
window.timeago.render(document.querySelectorAll('time'))
