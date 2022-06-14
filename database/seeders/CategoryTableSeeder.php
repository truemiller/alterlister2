<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Category::all()->sortByDesc('category_id') as $cat){
            $cat->delete();
        }

        $this->seedCategory('office-productivity', 'Office & Productivity', 'Office products ie. web-browsers, word processors and presentation software.');
        $this->seedCategory('browser', 'Web Browser', 'Web browsers, software that allow you to browse the web--and all of it\'s websites and pages.', 'office-productivity');
        $this->seedCategory('word-processor', 'Word Processor', 'Word processors allow you to type and edit text-based documents.', 'office-productivity');
        $this->seedCategory('spreadsheet', "Spreadsheet", 'Spreadsheets for managing Excel, CSV files and more.', 'office-productivity');
        $this->seedCategory('email-client', 'Email Client', 'Clients for managing your emails; inbox, sending, receiving.', 'office-productivity');

        $this->seedCategory('music', 'Audio & Music', 'Music software that allows you to listen to and/or stream music. Not to be confused with music production software.',);

        $this->seedCategory('business', 'Business', 'Business software ie. stock tracking, ecommerce, performance metrics.');

        $this->seedCategory('finance', 'Finance', 'Finance software ie. trading, portfolio management, banking.');
        $this->seedCategory('trading', 'Trading', 'Trading apps, software, and tools that you use to exchange, profit on, analyse, and trade markets. ', 'finance');

        $this->seedCategory('cryptocurrency', 'Cryptocurrency', 'Cryptocurrencys, digital monies, tokens, blockchain.',);
        $this->seedCategory('cryptocurrency-exchange', 'Cryptocurrency Exchange', 'Cryptocurrency exchanges where you can buy and sell digital currencies, tokens.', 'cryptocurrency');
        $this->seedCategory('cryptocurrency-wallet', 'Cryptocurrency Wallet', 'Cryptocurrency wallets store, send, receive cryptocurrencies--tokens and coins.', 'cryptocurrency');

        $this->seedCategory('photos-graphics', 'Photos & Graphics', '');
        $this->seedCategory('graphic-design', 'Graphic Design', 'Graphic design software used to create and manipulate digital images.', 'photos-graphics');

        $this->seedCategory('games', 'Games', 'Games ie. video games, single & multiplayer games.');

        $this->seedCategory('development', 'Development', 'Software development tools ie. IDEs, editors.');
        $this->seedCategory('code-editor', 'Code Editor', 'Text editors are applications used to edit text, usually for programming purposes.', 'development');
        $this->seedCategory('ide', 'IDE', 'Integrated development environments.', 'development');

        $this->seedCategory('social-communications', 'Social & Communications', 'Social media, social networking, instant messengers, communication.');
        $this->seedCategory('social-media-automation', 'Social Media Automation', 'Automation tools for Social Media; scheduling, posting .etc', 'social-communications');
        $this->seedCategory('social-networking', 'Social Networking', 'Social networking websites and applications; social media.', 'social-communications');
        $this->seedCategory('random-video-chat', 'Random Video Chat', 'Video chats with strangers.', 'social-communications');

        $this->seedCategory('videos-movies', 'Videos & Movies', 'Sites and software for hosting and/or streaming videos and movies.');
        $this->seedCategory('live-streaming', 'Live Streaming', 'Streaming software for live streaming on sites like Twitch, YouTube, Facebook, ...', 'videos-movies');
        $this->seedCategory('video-editor', 'Video Editor', 'Software for video editing and production.', 'videos-movies');

        $this->seedCategory('music-production', 'Music Production', "Software for producing music.", 'music');

        $this->seedCategory('webcam-software', 'Webcam Software', 'Software for webcams.');
        $this->seedCategory('web-hosting', 'Web Hosting', 'Hosting for websites, webapps, and more.');

        $this->seedCategory('security-privacy', 'Security & Privacy', 'Protect your devices and internet traffic.');
        $this->seedCategory('vpn', 'VPN', 'A VPN can protect the information you share or access using your devices. ', 'security-privacy');
        $this->seedCategory('cdn', 'CDN', 'Content delivery networks. ', 'security-privacy');
        $this->seedCategory('firewall', 'Firewall', 'Firewalls protect you and your devices from hackers and malware. ', 'security-privacy');


        $this->seedCategory('file-sharing', 'File Sharing', 'Share files online.');
        $this->seedCategory('torrent-search-engine', 'Torrent Search Engine', 'Find torrents to download.', 'file-sharing');
        $this->seedCategory('torrent-client', 'Torrent Client', 'Find torrents to download.', 'file-sharing');

        $this->seedCategory('operating-system', 'Operating system', 'Run an operating system on your device.');
    }

    /**
     * @param $slug 'The slug used for the category'
     * @param $title 'The title used for the category, will be displayed en page'
     * @param $description 'The description of the category, will be displayed en page and used in meta tags'
     */
    public function seedCategory(string $slug, string $title, string $description, string $parent = null): void
    {
        // create
        $categoryBeingCreated = Category::updateOrCreate([
            'slug' => $slug
        ], [
            'title' => $title,
            'description' => $description
        ]);

        // if has parent then associate with parent
        if ($parent) {
            $_parent = Category::firstWhere('slug', $parent);
            $categoryBeingCreated->parent()
                                 ->associate($_parent)
                                 ->save();
        }


    }
}
