<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        DB::table('users')->insert([
            'id' => 1,
            'name' => env('TEST_USER', 'Test'),
            'email' => env('TEST_EMAIL', 'your@email.com'),
            'password' => bcrypt( env('TEST_PASS', 'test') ),
        ]);

        DB::table('channels')->insert([
            ['id' => 16, 'ytid' => 'UCDhu1klCDnf2glev0YbYkDA', 'name' => 'BeHaind', 'description' => 'Hallo sie! Ja, sie! Suchen sie Pranks, LetsPlays, 10 Arten von-Toplisten und viele weitere tolle Videos, die es schon überall sonst im Internet gibt? Ja? Dann viel Spaß beim Weitersuchen. Hier gibt es ausschließlich Kram, die dem Uhrheber (das bin ich) die Work-Life-Balance zergrätschen. \n\nImpressum:\n\nBeHaind\nc/o David Hain\nStrelitzer Straße 60\n10115 Berlin'],
        	['id' => 17, 'ytid' => 'UCHyt6whzbCcG18q3m4ws6jw', 'name' => 'Nerdkultur', 'description' => 'Auf "Nerdkultur" gibt es die neuesten Previews, Reviews und vor allem Specials rund um all das, was man gerne augenzwinkernd als "nerdig" bezeichnet, aber verdient hat, ernst genommen zu werden - von und mit Marco Risch.\n\nPostanschrift: Webedia Gaming GmbH │ Marco Risch │ Ridlerstraße 55 │ 80339 München\n\nImpressum: Webedia Gaming GmbH · Ridlerstraße 55 · 80339 München\ngamestar.de gamepro.de onlinewelten.com areagames.de makinggames.biz jointheallyance.com de.ign.com \n​Sitz der Gesellschaft: München, Deutschland | Geschäftsadresse: Ridlerstraße 55 · 80339 München\nAmtsgericht München | HRB 218859 | Geschäftsführer: Nicolas John'],
        	['id' => 18, 'ytid' => 'UCQvTDmHza8erxZqDkjQ4bQQ', 'name' => 'Rocket Beans TV', 'description' => 'Rocket Beans TV steht für 24/7-Entertainment-Power rund um Gaming und Popkultur! Seit seinem Start am 15.01.2015 hat sich Deutschlands einziger unabhängiger Online-TV-Sender zum europaweit erfolgreichsten Kanal auf der Streaming-Plattform Twitch entwickelt. \nSeit dem 01.09.2016 sendet Rocket Beans TV 24 Stunden pro Tag auf YouTube. Mit seinem interaktiven, ungewöhnlichen Programmangebot und Auftritten prominenter Gäste (z.B. Moritz Bleibtreu, André Schürrle, Smudo uvm.), begeistern die Rocket Beans bis zu 120.000 Zuschauer täglich. Ausgezeichnet mit dem Deutschen Webvideopreis 2014 und 2015 sowie dem 1. Deutschen Content Marketing Preis desselben Jahres gestaltet Rocket Beans TV die Fernsehunterhaltung der Zukunft.\n\nDie Rocket Beans Entertainment GmbH ist Mitglied der USK.\n\nJugendschutzbeauftragter:\nUSK Unterhaltungssoftware Selbstkontrolle\nTorstr. 6, 10119 Berlin\njugendschutzbeauftragter@usk.de'],
        	['id' => 19, 'ytid' => 'UCtSP1OA6jO4quIGLae7Fb4g', 'name' => 'Rocket Beans TV Gaming', 'description' => 'Rocket Beans TV steht für 24/7-Entertainment-Power rund um Gaming und Popkultur!\nSeit seinem Start am 15.01.2015 hat sich Deutschlands einziger unabhängiger Online-TV-Sender zum europaweit erfolgreichsten Kanal auf der Streaming-Plattform Twitch entwickelt. Mit seinem interaktiven, ungewöhnlichen Programmangebot und Auftritten prominenter Gäste (z.B. Moritz Bleibtreu, André Schürrle, Smudo uvm.), begeistern die Rocket Beans bis zu 120.000 Zuschauer täglich. Ausgezeichnet mit dem Deutschen Webvideopreis 2014 und 2015 sowie dem 1. Deutschen Content Marketing Preis desselben Jahres gestaltet Rocket Beans TV die Fernsehunterhaltung der Zukunft.'],
        	['id' => 20, 'ytid' => 'UCC3L8QaxqEGUiBC252GHy3w', 'name' => 'Stefan Molyneux', 'description' => 'Freedomain Radio is the largest and most popular philosophy show on the web, with over 250 million downloads and is 100% funded by viewers like you. Please support the show by making a one time donation or signing up for a monthly recurring donation. https://freedomainradio.com/donate'],
        	['id' => 21, 'ytid' => 'UCL_f53ZEJxp8TtlOkHwMV9Q', 'name' => 'Jordan B Peterson', 'description' => 'Support this channel\'s development at www.patreon.com/jordanbpeterson and paypal.me/drjordanbpeterson.\n\nThis channel presents video lectures by Dr. Jordan B Peterson (psychology department, University of Toronto). Dr. Peterson is a professor and clinical psychologist. The lectures stem from two sources: \n1. His U Toronto courses Maps of Meaning, which describes how values, including beliefs about good and evil, regulate emotion and motivation and Personality and Its Transformations, which describes psychological theories from Eliade, Jung, Freud, Rogers, Gray, Luria, Sokolov, Vinogradova, Panksepp, Nietzsche, Kierkegaard, and Solzhenitsyn, as well as psychometric models such as the Big Five. \n2. His public lectures on topics of general psychological relevance, including the meaning of music, the significance of hero mythology, and the structure of the world as represented in religion.\n\nCheck out my Clips Channel for shorter videos - https://www.youtube.com/c/JordanBPetersonClips'],
        	['id' => 22, 'ytid' => 'UCrTNhL_yO3tPTdQ5XgmmWjA', 'name' => 'RedLetterMedia', 'description' => 'Red Letter Media is responsible for the 70 minute Phantom Menace review as well as Space Cop, Half in the Bag, and Best of the Worst. Full time frauds.'],
        	['id' => 23, 'ytid' => 'UC4zKSynEH_sLA1TC8_kU0gQ', 'name' => 'Oliver Harper', 'description' => 'Retrospectives and Reviews on classic movies from the 80s and 90s!!.\n\nTo gain access to reviews and commentaries early you can donate through Patreon! http://www.patreon.com/oliverharper\n\nI\'am available for any freelance work. Please drop me a message if you need assistance.\n\nIf you act immature, childish, post offensive and rude comments aimed at me or the viewers your comments will be removed and you will be banned.'],
        	['id' => 24, 'ytid' => 'UC0M0rxSz3IF0CsSour1iWmw', 'name' => 'Cinemassacre', 'description' => 'Cinemassacre Productions! James Rolfe and Mike Matei bring you many different gaming related web series including: Angry Video Game Nerd, James & Mike Mondays, Live Streams and more! \n\nJames on Twitter https://twitter.com/cinemassacre\nMike Matei on Twitter  https://twitter.com/Mike_Matei\n\nWant us to take a look at your indie game title? Contact / send Steam Keys to:\nMike@Cinemassacre.com\n\nVisit our website Cinemassacre.com\n\nWant to donate a game? Contact Mike Matei via email at Mike@Cinemassacre.com\n\nOften times we get e-mails from people that say they have not been notified of our newest videos. That’s probably because you have not clicked on the bell! To get notified of every video we put out, you must click the bell icon when you subscribe to out channel. Then, checkmark “allow notifications” and click SAVE. Never miss a Cinemassacre video again!'],
        	['id' => 25, 'ytid' => 'UCiH828EtgQjTyNIMH6YiOSw', 'name' => 'Channel Awesome', 'description' => 'The ONLY Official Youtube channel for the Nostalgia Critic and Channel Awesome.\n\nNew Nostalgia Critic episodes every Wednesday at 5PM CST.\n\nNew Top 5 Best/Worst episodes every Tuesday at 5PM CST.\n\nNew 1st Viewings or Real Thoughts episodes every Thursday at 5PM CST.\n\nNew Tamara\'s Never Seen episodes every Friday at 5PM CST.\n\nNew Tamara Just Saw episodes every Saturday at 5PM CST.\n\nClassic Nostalgia Critic episodes are uploaded after they are cleared.  TV Show Vlogs are uploaded on an inconsistent schedule, so check the playlists.  Same with Doug Reviews, Sibling Rivalry, and Bum Reviews.\n\nThanks for watching!'],
        	['id' => 26, 'ytid' => 'UCsgv2QHkT2ljEixyulzOnUQ', 'name' => 'AngryJoeShow', 'description' => 'AngryJoeShow - Just one Guys Opinion on Games, Movies & Geek Stuff.\n\nSpread the word &share my channel with your friends!\n\nI work hard to release 2-3 vids a week! Hows about a $1 donation to keep my supply of Dr.Pepper (Now Red Bull) going! =)\n\nDonate button at my site! It helps me go crazy & bigger on the next review!\n\nMy "GO! to the Website" Theme Song\nis done by Callenish Circle\n"Suffer my Disbelief"'],
        	['id' => 27, 'ytid' => 'UC8TdfFu8YDSqFdmkHHxrk8Q', 'name' => 'Film Brain', 'description' => 'Cinematic masochist Film Brain takes a look at the very worst Hollywood (and elsewhere) has to offer, with snarky but thorough and insightful commentary, including behind the scenes info! Strap in, hold on tight and embrace the SYMBOLISM!'],
        	['id' => 28, 'ytid' => 'UCG1h-Wqjtwz7uUANw6gazRw', 'name' => 'Lindsay Ellis', 'description' => ''],
        	['id' => 29, 'ytid' => 'UC-lHJZR3Gqxm24_Vd_AJ5Yw', 'name' => 'PewDiePie', 'description' => 'I make videos.'],
        	['id' => 30, 'ytid' => 'UCIveFvW-ARp_B_RckhweNJw', 'name' => 'StevenCrowder', 'description' => 'Pop culture and politics from the most politically incorrect comedy channel on the web. Hippies and Muslims hate me!'],
        	['id' => 31, 'ytid' => 'UCZViJTyN0OXTTuPQ2mimNWw', 'name' => 'PhilosophyInsights', 'description' => 'PhilosophyInsights. This channel aims at extracting central points of presentations into short clips. The focus is on central ideas of classical liberalism, conservatism and libertarianism and the problems of leftist ideology, including feminism, social justice, post-modernism, socialism and Marxism. \nIf you like the content, subscribe to the channel!\n\nChannelsymbol: Plato. (c) by Dabid J. Pascual, ES. Licence under creative common.'],
        	['id' => 32, 'ytid' => 'UCieg8PwDJ7G--4GPVm3Hg8A', 'name' => 'DICED', 'description' => 'DICED ist die erste und einzige TV Show mit dem Thema Tabletop- und Miniaturenspiele.\nJeden Samstag wird DICED, seit April 2015 um 18 Uhr auf Rocketbeans.tv ausgestrahlt und hat bis zu 7500 Zuschauer.\nDICED befasst sich mit Tabletop- und Miniaturenspiele sowie Wargames im Allgemeinen.\nBemalanleitungen, Reviews und eine äußerst subjektive Meinung aus und über die Szene werden auf diesem Channel zu finden sein.\nDie aktuellen Videos welche auf Rocketbeans laufen, erscheinen auf dem Youtubekanal am darauf folgenden Mittwoch.\n\nGegründet von Denis, dem Kopf hinter MAGABOTATO, dem Magazine about Tabletop, zieht der Kerl, der ums Verrecken nicht moderieren kann,\nhier sein eigenes Ding durch. \nAbonniert den Channel und verpasst kein Video.'],
        	['id' => 33, 'ytid' => 'UC0aanx5rpr7D1M7KCFYzrLQ', 'name' => 'Shoe0nHead', 'description' => 'hello, i\'m june. i am 26. i live in new york. i am extremely online.\ni currently do comedic socio-political commentary on things such as feminism and women\'s media\ni have a holland lop bunny named ollie\nstick around if you like loud screeching and bad memes.\n\n“If you want to tell people the truth, make them laugh, otherwise they\'ll kill you.”\n-Oscar Wilde\n\nFAQ:\n[coming soon]\n\nPO box:\nGregory Fluhrer\nArmoured Media\nP.O. Box 29003\nPortsmouth P.O.\nKingston, ON\nK7M 8W6'],
        	['id' => 34, 'ytid' => 'UCLfU0s7hrfgKs11YWUwSimA', 'name' => '50 Stars', 'description' => 'Welcome to 50 Stars. A Conservative Political Compilation Channel. People featured here include Dinesh D\'Souza, Thomas Sowell, Ben Shapiro, Yaron Brook, Milo Yiannopoulos, Trey Gowdy, Ann Coulter, Donald Trump e.t.c. \n\nSubscribe to our channel to learn & watch leftists getting owned. \n\nSUBSCRIBE NOW'],
        	['id' => 35, 'ytid' => 'UCcmnLu5cGUGeLy744WS-fsg', 'name' => 'karen straughan', 'description' => 'Writing and vlogging on gender issues fearlessly since 2010.'],
        	['id' => 36, 'ytid' => 'UCjbgKUcTjpxmuW-8U0LR80Q', 'name' => 'Independent Man', 'description' => ''],
        	['id' => 37, 'ytid' => 'UCmrLCXSDScliR7q8AxxjvXg', 'name' => 'Black Pigeon Speaks', 'description' => '"An attack upon our ability to tell stories is not just censorship - it is a crime against our nature as human beings." - Salman Rushdie'],
        	['id' => 38, 'ytid' => 'UChLq7CFB8goG47sCf_sDmFg', 'name' => 'Trade of ideas', 'description' => 'Trade of ideas is a channel dedicated to the search for innovation, development and production of videos of various ideas. To change the world in which we live, not to always see types of standard objects.   "EXITING THE SCHEMES ! "'],
        	['id' => 39, 'ytid' => 'UCngItZfU0Or24TmyUoc1BZA', 'name' => 'Self MaKeR', 'description' => ''],
        	['id' => 40, 'ytid' => 'UCD8WuXVr-v0emXPwT2GUX1w', 'name' => 'YouFact DE', 'description' => ''],
        	['id' => 41, 'ytid' => 'UCAiKrZDrrSJnLpDM-zEVyng', 'name' => 'DoubleMoose', 'description' => ''],
        	['id' => 42, 'ytid' => 'UCG749Dj4V2fKa143f8sE60Q', 'name' => 'Tim Pool', 'description' => 'Tim Pool brings you breaking news from around the world and commentary on top news topics in Politics and Cultural issues\naround the world.\n\nStay tuned for live news, livestreams, breaking stories, everyday and a new podcast episode of "The Culture War" every Sunday at 4pm.\n\nNon Business Contact: Tim@Tagg.ly'],
        	['id' => 43, 'ytid' => 'UC7_YxT-KID8kRbqZo7MyscQ', 'name' => 'Markiplier', 'description' => 'Welcome to Markiplier! Here you\'ll find some hilarious gaming videos, original comedy sketches, animated parodies, and other bits of entertainment! If this sounds like your kind of channel then please Subscribe Today!\n\nTotal Charity Raised ▶ $3,000,000+'],
        ]);

        DB::table('metachannels')->insert([
            ['id' => 20, 'user_id' => 1, 'name' => 'Deutsche Channel', 'description' => '...die ok sind.', 'created_at' => '2017-12-20 12:41:27', 'updated_at' => '2018-06-13 10:16:38', 'last_refresh' => '2018-06-13 10:16:38'],
        	['id' => 21, 'user_id' => 1, 'name' => 'Philosophy', 'description' => '101', 'created_at' => '2017-12-20 12:42:14', 'updated_at' => '2018-06-06 21:09:05', 'last_refresh' => '2018-06-06 21:09:05'],
        	['id' => 22, 'user_id' => 1, 'name' => 'Movies', 'description' => 'Movie Reviews', 'created_at' => '2017-12-20 12:43:01', 'updated_at' => '2018-06-12 13:39:35', 'last_refresh' => '2018-06-12 13:39:35'],
        	['id' => 23, 'user_id' => 1, 'name' => 'Channel Awesome and Friends', 'description' => 'good old fun', 'created_at' => '2017-12-20 12:45:02', 'updated_at' => '2018-06-06 21:17:19', 'last_refresh' => '2018-06-06 21:17:19'],
        	['id' => 24, 'user_id' => 1, 'name' => 'Humour', 'description' => 'Humour', 'created_at' => '2017-12-20 12:46:00', 'updated_at' => '2018-06-13 08:48:59', 'last_refresh' => '2018-06-13 08:48:59'],
        	['id' => 25, 'user_id' => 1, 'name' => 'Politics', 'description' => 'politics', 'created_at' => '2017-12-20 12:47:07', 'updated_at' => '2018-06-13 08:51:25', 'last_refresh' => '2018-06-13 08:51:25'],
        	['id' => 26, 'user_id' => NULL, 'name' => 'Trade of ideas', 'description' => 'Trade of ideas is a channel dedicated to the search for innovation, development and production of videos of various ideas. To change the world in which we live, not to always see types of standard objects. "EXITING THE SCHEMES ! "', 'created_at' => '2018-04-17 18:05:11', 'updated_at' => '2018-06-06 16:23:45', 'last_refresh' => '2018-06-06 16:23:45'],
        	['id' => 27, 'user_id' => NULL, 'name' => 'Self MaKeR', 'description' => 'HOW TO MAKE', 'created_at' => '2018-04-17 18:23:25', 'updated_at' => '2018-06-06 10:37:06', 'last_refresh' => '2018-06-06 10:37:06'],
        ]);

        DB::table('channel_metachannel')->insert([
            ['channel_id' => 22, 'metachannel_id' => 22],
        	['channel_id' => 23, 'metachannel_id' => 22],
        	['channel_id' => 24, 'metachannel_id' => 23],
        	['channel_id' => 25, 'metachannel_id' => 23],
        	['channel_id' => 26, 'metachannel_id' => 23],
        	['channel_id' => 27, 'metachannel_id' => 23],
        	['channel_id' => 28, 'metachannel_id' => 23],
        	['channel_id' => 20, 'metachannel_id' => 21],
        	['channel_id' => 16, 'metachannel_id' => 20],
        	['channel_id' => 17, 'metachannel_id' => 20],
        	['channel_id' => 18, 'metachannel_id' => 20],
        	['channel_id' => 19, 'metachannel_id' => 20],
        	['channel_id' => 32, 'metachannel_id' => 20],
        	['channel_id' => 30, 'metachannel_id' => 25],
        	['channel_id' => 36, 'metachannel_id' => 25],
        	['channel_id' => 38, 'metachannel_id' => 26],
        	['channel_id' => 39, 'metachannel_id' => 27],
        	['channel_id' => 29, 'metachannel_id' => 24],
        ]);
    }
}
