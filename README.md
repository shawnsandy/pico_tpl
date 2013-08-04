pico_tpl
========

A simple templating(tpl) system for pico that allows you to include dynamic twig html-templates / views to predefined sections of your pico theme.

Installation
------------

1. Copy the plugin file/folder the plugins directory of your Pico site.
2. Open the pico config.php and insert add and config['tpl_array'] = array('header','content','footer','cover','sidebar') change for your theme.
3. Create a tpl folder in your theme folder and add you content.html files to it.
4. You can use twig's include function to load tpl(s) `{% include tpl.content ignore missing %}` the plugin will load your pagename-content.html or content.html if that file does not exist, missing files are simple ignored
5. Create a tpl folder in your theme folder and add you content.html files to it
6. Views -- you can create place reusable html twig snippets in the views folder add `{% include views.filename ignore missing %}` to you theme, and you have a simple way to re-use html files.

Samples
-------
Coming soon...

License
-------

### Released under the MIT license.

Copyright (c) <year> <copyright holders>

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.