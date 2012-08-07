## openSUSE Bento wordpress theme

"Bento" is the official set of themes of openSUSE project. This is the wordpress part which is originally on gitorious.org/openSUSE/wp-themes.

But this theme used a query against static.opensuse.org, which has many shortcomings for a self-hosted blog, because it'll download header like "download" and footer like "copyright novell".

So I fork it and make changes to make it more convenient for normal people.

Screenshot:

![](http://news.opensuse.org/wp-content/themes/bento/screenshot.png)

### Demo

Original see any of this:

[http://news.opensuse.org](http://news.opensuse.org)

[http://lizards.opensuse.org](http://lizards.opensuse.org)

<del>http://spotlight.opensuse.org</del> - no longer visitable


My fork in use see [http://suse.ws](http://suse.ws) which is official Chinese openSUSE new aggrevagator.

Marguerite

--------- ORIGINAL README ---------

This is the new openSUSE.org Theme called Bento.

Warning: This theme is stillunder construction and not ready for serious use! It use in some places still some CSS3 which will not work in meny browsers. This code was added just for mockup-reasons.

To get further informations visit: http://en.opensuse.org/Boosters_Team/Projects/Integrate_all_Infrastructure_under_one_Umbrella

To learn more about the theme read /HOWTO.

This Theme should later fully support the following browsers:

* Firefox     3.5 / 3.6 / or higher
* Chrome      5.*  / or higher
* Safari      4.0.4 / or higher
* Opera       10  / or higher
* Konqueror   4 / or higher
* IE          7 / 8 / or higher

If you have any questions, send a mail to rlihm@opensuse.org

# Includes #

Page parts, which are common in pages should be moved as snippets into includes/. E.g. the footer should be moved as footer.html
