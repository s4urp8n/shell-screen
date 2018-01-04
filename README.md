    
# Linux shell "screen" command php wrapper


```
composer require zver/shell-screen
```

```
composer install
php test.php
```

## Usage

```
<?php

//run screen with command
\Zver\ShellScreen::run('screenname','sleep 5');
//or commands
\Zver\ShellScreen::run('screenname',['echo "123"','sleep 5']);
//NOTE When command finished execution screen will be automatically closed

//quit screen
//NOTE command maybe still working, screen - terminated anyway

\Zver\ShellScreen::run('screenname');

```