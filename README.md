# job-board

Codeigniter framework
My first OOP project, made 2013.

This is free and unencumbered software released into the public domain.

Anyone is free to copy, modify, publish, use, compile, sell, or
distribute this software, either in source code form or as a compiled
binary, for any purpose, commercial or non-commercial, and by any
means.

In jurisdictions that recognize copyright laws, the author or authors
of this software dedicate any and all copyright interest in the
software to the public domain. We make this dedication for the benefit
of the public at large and to the detriment of our heirs and
successors. We intend this dedication to be an overt act of
relinquishment in perpetuity of all present and future rights to this
software under copyright law.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
IN NO EVENT SHALL THE AUTHORS BE LIABLE FOR ANY CLAIM, DAMAGES OR
OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE,
ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
OTHER DEALINGS IN THE SOFTWARE.

For more information, please refer to <http://unlicense.org/>


Installation:
Install job board.sql file in JobBoard database.
Mysql user = root, Mysql pass = ''
There are three types of administration:
1. user, type = 0 in the users table
2. superadmin type = 2 in the users table
3. company type = 1 in the company table

Login:
user path = job-board/login
company path = job-board/login
superadmin path job-board/adminlogin
Built-in Facebook login / registration, only users (type = 0) can login / register via Facebook

Users can post job advertisements and advertise the need for personal transport (hitchhiking) from one place to another.
The company can advertise the need for new workers.
Superadmin može nadgledati sve korisnike, brisati objave, blokirati koisnike...itd
