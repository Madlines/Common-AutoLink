# Madlines Common-AutoLink

It is a very simple lib that turns all urls in given input into anchors.

## Installation
You can install it using composer:

```
composer require madlines/common-autolink
```

## Usage
```php
<?php

use Madlines\Common\AutoLink\AutoLink;

$input = 'My string containing some urls like www.example.com or smth more fancy like https://www.example.com:8803/foo/bar?lorem=ipsum#dolor/sit/amet';
$output = AutoLink::parse($input);
```

And it shall return the following string:

```html
My string containing some urls like <a href="http://www.example.com" target="_blank">www.example.com</a> or smth more fancy like <a href="https://www.example.com:8803/foo/bar?lorem=ipsum#dolor/sit/amet" target="_blank">www.example.com:8803/foo/bar?lorem=ipsum#dolor/sit/amet</a>
```

### For Symfony + Twig users
You can simply turn it into Twig extension if you'd like to:

```php
<?php

namespace MyApp\MyBundle\Twig;

use Madlines\Common\AutoLink\AutoLink;

class AutoLinkExtension extends \Twig_Extension
{
    const NAME = 'auto_link_extension';

    /**
     * @return array
     */
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('auto_link', [$this, 'autoLink']),
        ];
    }

    /**
     * @param string $text
     * @return string
     */
    public function autoLink($text)
    {
        return AutoLink::parse($text)
    }

    /**
     * @return string
     */
    public function getName()
    {
        return self::NAME;
    }
}
```

service configuration in services.yml

```yml
my.twig_extension.auto_link:
    class: MyApp\MyBundle\Twig\AutoLinkExtension
        public: false
        tags:
            - { name: twig.extension }
```
