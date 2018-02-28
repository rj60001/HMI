# Nomios - Evaluation

*Note that the tests referenced are discussed in my Test Results and Test Plan*

## Has The Solution Met The Objectives?

Perhaps the best way to address this question is by first reading my objectives from my analysis:

> 1. The user should be able to start threads in the forum so that they can ask questions, further their knowledge and collaborate with other scientists.
> 2. The user should be able to respond to threads and messages within threads so that communication can take place between users.
> 3. The user should not be able to remove any messages that they have posted or threads that they have started. This is to make sure that other users can still access old questions so that they can learn from them too.
> 4. The user should be able to process a sequence of histone modifications on a particular gene **and** receive a result that lets them know what the change in expression will be. This is fundamental to the solution as it lets users predict how much a  gene is expressed without conducting expensive lab work.
> 5. The user should be able to edit a DNA sequence so that they can (for example) amend any errors produced and change the current allele to another allele. They should be able to change the sequence of histones to change the resultant expression of the gene.
> 6. The user should be able to describe what a particular sequence does and be able to name a sequence so that they can differentiate sequences from each other.
> 7. The user should be able to view groups of sequences that attribute to a particular disease so that they can collaborate with other scientists on research for a particular disease.
> 8. The user should be able to search for other sequences, sequences within diseases and threads including their own so that they can benefit from other users' data and navigate to their own for their own research.
> 9. The user should have their own account so that the data that they have submitted can be attributed to them. Similarly, they should not be able to submit new data without being signed into an account to ensure that new data is attributed to their account.
> 10. There should be a "help" menu that the user can navigate to so that they can learn to use the website quickly and easily.
> 11. Users should be able to style their forum posts using some form of mark up. This will enhance communication between users as it structures texts to be more easily read and have a greater emphasis on particular words.
> 12. HTML should not be a valid form of text when submitting posts to forums or creating notes and names for particular sequences and diseases. This is to prevent malicious attacks on the website that may distort its intended display.
> 13. An admin should be available in the forum that can delete inappropriate threads, messages or replies. This is to ensure that the forum remains a friendly place to communicate so that users maintain communication and collaboration.
> 14. The result displayed once a histone sequence is interpreted (i.e. the change in expression of a gene) should be accurate to what is observed in real life.
> 15. The website must be viewable on a mobile and desktop device so that it can be accessed by a user no matter their device preference.

We will go through each of these objectives one at a time and evaluate them to find out whether or not we have met that particular objective.

> 1. The user should be able to start threads in the forum so that they can ask questions, further their knowledge and collaborate with other scientists.

This is possible as discovered by test 0. The user has a large set of inputs to ask a wide range of questions and to discuss certain topics. This objective has been met.

> The user should be able to respond to threads and messages within threads so that communication can take place between users.

This is possible as shown by tests 1, 2 and 3. Those tests were successful so this objective has been met. This means that users can converse with each other bout a particular topic or question which allows for more communication via the forum.

> The user should not be able to remove any messages that they have posted or threads that they have started. This is to make sure that other users can still access old questions so that they can learn from them too.

This is possible as shown by test 7. That test was successful so this objective has been met. However, it is difficult for users to navigate to extremely old posts without searching. This is because **pagination** is not implemented (this is where different pages containing different results - in this case threads -  are generated).

> The user should be able to process a sequence of histone modifications on a particular gene **and** receive a result that lets them know what the change in expression will be. This is fundamental to the solution as it lets users predict how much a gene is expressed without conducting expensive lab work.

The tests 16, 17 and 18 test this and are all successful. Therefore this objective has been met. However, only naturally occurring histone modification sequences should be processed as these are the only histone modification sequences that are valid (i.e. the pattern of histone modifications adheres to the rules of histone modification sequences).

> The user should be able to edit a DNA sequence so that they can (for example) amend any errors produced and change the current allele to another allele. They should be able to change the sequence of histones to change the resultant expression of the gene.

Test 12 tests this and was successful. Therefore this objective has been met. The DNA sequence and histone modification sequence for a specific nucleosome (and therefore the entire nucleosome sequence) can be altered.

> The user should be able to describe what a particular sequence does and be able to name a sequence so that they can differentiate sequences from each other.

Test D tests this and was successful. Therefore the objective has been met. Using the *notes* section a user can describe what a particular sequence does. Users are prevented from naming two of their own sequences the same. This means that users can differentiate sequences from each other.

> The user should be able to view groups of sequences that attribute to a particular disease so that they can collaborate with other scientists on research for a particular disease.

Test F tests this and was successful. Therefore, this objective has been met. Nucleosome sequences that are associated with the same disease are grouped together on a signal disease page. Scientists can contribute to these sequences so that they can collaborate on the research for a particular disease.

> The user should be able to search for other sequences, sequences within diseases and threads including their own so that they can benefit from other users' data and navigate to their own for their own research.

Tests 19 and 1A test this. They were successful. Therefore, the objective has been met. Users can use the search page to find a specific sequence, thread or disease by name. The results can be further filtered to only return the own user's sequences, threads and diseases.

> The user should have their own account so that the data that they have submitted can be attributed to them. Similarly, they should not be able to submit new data without being signed into an account to ensure that new data is attributed to their account.

Tests A and B test this. They were both successful. Therefore this objective has been met. A user can create an account (test A) and only access the forum and tool pages (and therefore can only submit data) if they are signed into that account (test B).

> There should be a "help" menu that the user can navigate to so that they can learn to use the website quickly and easily.

Test 9 tests this. It was successful. Therefore this objective has been met. The help menu is clearly displayed to the user and is always accessible from any page. Therefore, the user can learn to use the website very quickly.

> Users should be able to style their forum posts using some form of mark up. This will enhance communication between users as it structures texts to be more easily read and have a greater emphasis on particular words.

Test 8 test this and it was successful. Therefore, the objective has been met. The user can style posts using an artificial mark up, allowing them to structure their text and enhance communication.

> HTML should not be a valid form of text when submitting posts to forums or creating notes and names for particular sequences and diseases. This is to prevent malicious attacks on the website that may distort its intended display.

This is tested by test 5. This test was successful. The HTML tags were removed from the submitted text, preventing malicious code from being stored in the database. This prevents malicious client side code from being executed and prevents malicious attacks. This objective has therefore been met.

> An admin should be available in the forum that can delete inappropriate threads, messages or replies. This is to ensure that the forum remains a friendly place to communicate so that users maintain communication and collaboration.

This was tested by test 6 and was successful. Therefore, the objective has been met. Admins can removed inappropriate posts and threads, maintaining a friendly atmosphere within the forum. These posts and threads are deleted, censoring offensive material.

> The result displayed once a histone sequence is interpreted (i.e. the change in expression of a gene) should be accurate to what is observed in real life.

The tests 16, 17 and 18 test this and are all successful. Therefore this objective has been met. The result displayed from an interpreted histone modification sequence is accurate to the real life expectations. Therefore the histone modification interpreter is accurate.

> The website must be viewable on a mobile and desktop device so that it can be accessed by a user no matter their device preference.

CSS code has been programmed which changes the design of the user interface depending on the device used. This could only be simulated however as the website is not live hosted during testing and therefore cannot be accessed by mobile devices. This objective has thus been met.

## In What Ways Can The Solution Improve?

One way the solution could be improved is by providing a feature that lets the users search for specific histone modifications and read about their discovery, their effects and any other important information attached to them. This would allow the epigeneticists to quickly find the effects of a single histone modification instead of only allowing them to find out information on entire histone modification sequences. This would also help a user epigeneticists understand another user's nucleosome sequence, therefore encouraging a more open scientific community.

Another way the solution could be improved is by creating a second tool. This tool could be used to predict the effect on expression of artificial histone modification sequences. This would be useful for biotechnology industries that may make use of an artificial histone modification sequence and therefore help researching in epigenetics by reduces time-consumption and resources. This would be significantly more complex to create as there is a complex set of rules that govern which histone modifications are allowed in a sequence with of modifications and which aren't.

A **layer** is a set of posts that respond to the same post. Level 1 for example are all posts that respond to the original message, level 2, to those messages, etc. The forum currently only supports up to level 2. If it expanded to include a much higher maximum level then users could create a much more complex thread which simultaneous conversations occurring at different levels in response to different posts. This would enhance communication greatly as more communication can take place at the same time. For example, a variety of solutions could be suggested for a particular problem that was posted. So when a later user visits the thread they have a much better chance at finding the actual solution for that problem.

## What Does The Target Audience Think?

After using he forum Henry wrote:

> I love the use of the artificial mark up! I feel that it structures the text well so that a point can be put across well to another user. However, it is limited to only certain tags (for example, `[b][/b]` for emboldening text).

If I were to improve this solution I would add in extra mark up tags. This could be including different types of lists and hyperlinks. This could open up the website to external services and websites, such as *Wikipedia* pages for sources for answers within the forum. This would encourage more accurate answers to question within the forum. 

After using the histone modification interpreter, Luke said:

> The help guide is incredibly useful as it can be accessed anywhere on the website straight from the menubar. The nucleosome sequences are broken down into a nucleosomes which are each displayed too. However, I find it difficult to copy and paste DNA sequences to other applications - I copy other texts on the web page. This is because no highlighting is shown to the user when selecting text to copy. This should be addressed.

If I were to improve this solution I would change the CSS code used so that when text is selected it is highlighted. This will show the user what text they're selecting. This prevents them from accidentally selecting other, unwanted text or even images. This lets users copy and paste DNA sequences to other applications, which was one of the demands outlined by my target audience in my *Analysis*.