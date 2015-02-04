# Meetup-Featured-Event
PHP and HTML to get and display featured Meetup event from a group

This PHP code snippet was created for Sunday Assembly Atlanta's website in order to show the featured event from their Meetup page.

I doesn't have much error checking and is written my someone new to web development and PHP, but perhaps it can be of use!

A few steps are necessary to customize it for your own purposes. I have labeled in comments where those steps are applied.

1. You must get your Meetup API key from their website, which lets Meetup know you have access to request information.
2. You may insert the group ID number from Meetup. Once I found this, I decided to use it instead of step 3's variable because I assumed it would be more reliably constant.
3. You may use the group's URL name instead of its group ID. Uncomment this line and its use in forming the following string if you want to do this. Comment out the group ID lines, as well.
- Note: You must do either 2 OR 3.
4. You may add to the extracted variables from the featured event and edit the presentation of the result.

Many commented-out debug lines are available to check responses.
