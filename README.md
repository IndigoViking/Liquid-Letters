# Liquid Letters plugin for Craft CMS 3.x

Count words, get reading times, and convert text to list items.

![Screenshot](resources/img/plugin-logo.png)

## Requirements

This plugin requires Craft CMS 3.0.0-beta.23 or later.

## Installation

To install the plugin, search for Liquid Letters in the plugin store or follow these instructions.

1. Open your terminal and go to your Craft project:

        cd /path/to/project

2. Then tell Composer to load the plugin:

        composer require indigoviking/liquid-letters

3. In the Control Panel, go to Settings → Plugins and click the “Install” button for Liquid Letters.

## Liquid Letters Overview

Liquid Letters adds Twig filters to count words, give reading times, and convert text to list items.

## Using Word Count

`{{ entry.field | wordCount }}`

Will output

`100`

## Using Read Time

The `readTime` filter requires a timing parameter of seconds(`sec`), minutes(`min`), hours(`hr`), or days(`day`, just for fun!).

###### Seconds

`{{ entry.field | readTime('sec')`

###### Minuts

`{{ entry.field | readTime('min')`

###### Hours

`{{ entry.field | readTime('hr')`

###### Days

`{{ entry.field | readTime('day')`

The output will be the number of the duration to read. If no timing or an invalid timing is submitted, the filter will return the text `timing invalid`.
