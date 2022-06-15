<?php

namespace Database\Seeders;

use App\Models\Alternative;
use App\Models\Category;
use App\Models\Entity;
use App\Models\EntityTag;
use App\Models\Platform;
use App\Models\Publisher;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class EntityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seedBrowsers();
        $this->seedSocialCommunications();
        $this->seedDevelopment();
        $this->seedMusic();
        $this->seedTrading();
        $this->seedPhotosGraphics();
        $this->seedCryptocurrency();
        $this->seedVPN();
        $this->seedLiveStreaming();
        $this->seedVideoMovies();
        $this->seedWordProcessor();
        $this->seedWebcamSoftware();
        $this->seedWebHosting();
        $this->seedOfficeProductivity();
        $this->seedOperatingSystem();
        $this->seedTorrents();
    }

    private function entitySeederLoop($software_array, $category_slug)
    {
        foreach ($software_array as $entityData) {
            print_r($entityData["slug"] . "\n");
            // TRY GET ENTITY
            $_ent = Entity::firstWhere("slug", $entityData["slug"]);


            // CREATE ENTITY
            $_ent = (new Entity)->updateOrCreate([
                'slug' => $entityData["slug"],
            ],
                [
                    'title' => $entityData["title"],
                    'description' => $entityData["description"] ?? "",
                    'logo' => $entityData["logo"] ?? "",
                    'link_1' => $entityData["link_1"] ?? "",
                    'category_id' => Category::firstWhere("slug", $category_slug)->id,
                    "user_id"=>1
                ]
            );

            // Create platform associations
            $platforms = [];
            $platforms = explode(',', $entityData["platforms"]);
            if ($platforms ?? false) {
                foreach ($platforms as $platform) {
                    $_platform = (new Platform)->where('slug', $platform)->first();
                    if ($_platform) {
                        $_ent->platforms()
                             ->attach(
                                 $_platform->id
                             );
                    }
                }
            }

            // drop tags
            EntityTag::where("entity_slug", "$_ent->slug")->delete();

            // create tags
            if (isset($entityData["tags"])) {
                foreach ($entityData["tags"] as $tag) {
                    $tagObject = Tag::updateOrCreate(["tag" => $tag]);
                    $entityTag = EntityTag::updateOrCreate(["entity_slug" => $_ent['slug'], "tag" => $tag]);
                    $entityTag->save();
                }
            }
        }

    }

    private
    function seedBrowsers(): void
    {
        $this->entitySeederLoop([
            [
                'title' => 'Chrome',
                'short_description' => 'Chrome is Google\'s proprietary web browser, free to download, and used by the majority of the internet.',
                'description' => 'Google Chrome is a fast, secure, easy-to-use web browser for all your devices. It\'s packed with features that help you get the most out of the web, but it\'s simple to use so you can keep focused on what matters. Chrome was created by Google on September 2, 2008, and has been rapidly gaining market share since then.  One of the reasons for Chrome\'s popularity is its security features; it has one of the best track records for keeping malware and viruses off your device. Another reason is its speed; it is consistently one of the fastest browsers available.  Some of the features that make Chrome stand out among other browsers are its ability to sync your bookmarks, passwords, and settings across all of your devices, its built-in PDF viewer and downloader, and its support for extensions and themes. You can also use Chrome to cast content from your device to a TV or other screen.  Google Chrome is perfect for use for both personal and business purposes - basically, anyone who needs to browse the web.',
                'logo' => asset('/img/logo/50x50/google-chrome_50x50.png'),
                'image_1' => "https://www.google.co.uk/chrome/static/images/homepage/laptop_desktop.png",
                'video_1' => "",
                'slug' => 'chrome',
                'link_1' => 'https://chrome.google.com',
                'platforms' => 'windows,mac,ios,android,linux,ubuntu',
                'publisher_slug' => 'google',
                'entity_type' => 'software',
                "tags" => ["web browser"]
            ],
            [
                'title' => 'Firefox',
                'short_description' => 'Mozilla Firefox, or simply Firefox, is a free and open-source web browser developed by the Mozilla Foundation and its subsidiary, Mozilla Corporation.',
                'description' => 'Firefox is a free web browser created by the Mozilla Foundation. The initial release of this innovative software dates back to September 23, 2002. When compared with others, Firefox is a smaller and faster browser that enhances your online browsing activities.  Firefox has a cleaner interface. Users enjoy a clutter-free application for web surfing. In addition to this, the software ensures faster downloading speeds. Toward the end of 2008, Firefox covered 20% of the browser\'s market share across the globe.  The software encompasses new additions persistently. For example, Firefox is the pioneer of the toolbar, bookmarks, and tabbed browsing. These features allow anyone to switch between various websites effortlessly, thus saving their valuable time.  Above all, Firefox employs enhanced security to safeguard your information from the prying eyes of intruders. The latest version includes various features such as an email component, a query linked to Google search, the ability to surf multiple search engines, a much better user interface, RSS feed support, improved tabbed browsing, phishing protection, spell checking, and the session restoration option.',
                'logo' => asset('/img/logo/50x50/mozilla-firefox_50x50.png'),
                'image_1' => "https://www.mozilla.org/media/img/firefox/new/desktop/screen.19f69ea7f0ea.png",
                'video_1' => "",
                'slug' => 'firefox',
                'link_1' => 'https://firefox.com',
                'platforms' => 'windows,mac,ios,android,linux,ubuntu',
                'publisher_slug' => 'mozilla',
                'entity_type' => 'software',
                "alternatives" => "chrome,opera,opera-gx,brave",
                "tags" => ["web browser"]
            ],
            [
                'title' => 'Opera',
                'description' => 'Opera is a web browser that was developed by Opera Software. It is distributed as an installer for Windows, Mac OS X and Linux. Opera has been available for free since it was released in 1996. It isn’t currently available on any other operating system.  Opera has been used by over 80% of internet users. Opera utilizes an innovative feature known as WebGL, which allows it to run graphics in real-time on a web page. Opera also allows you to customize your browsing experience by assigning favorite websites or bookmarks and setting different browsing modes for various sites or documents.  Opera web browser has an exciting feature called “The Browser,” which allows you to access your most visited pages even without being in full-screen mode. Instead of using one page to load all your pages, it loads them in background mode. You can use this feature if you want the maximum performance while surfing the Web while using a large screen with a high resolution like an HD monitor or laptop display at work or home.',
                'logo' => asset('/img/logo/50x50/opera_50x50.png'),
                'image_1' => "https://cdn-production-opera-website.operacdn.com/staticfiles/assets/images/main/home/opera-for-desktop--rebranding.bb3b30959b70.png",
                'video_1' => "",
                'slug' => 'opera',
                'link_1' => 'https://opera.com',
                'platforms' => 'windows,mac,ios,android,linux,ubuntu',
                'publisher_slug' => 'opera',
                'entity_type' => 'software',
                "alternatives" => "chrome,firefox,opera-gx,brave",
                "tags" => ["web browser"]
            ],
            [
                'title' => 'Brave',
                'slug' => 'brave',
                'description' => 'Brave Software is a newly designed open-source web browser designed by Brave Software Incorporated, in Santa Clara California.   It is based on the designs of the google chrome web browser. The Brave primary design is for privacy focus by blocking online advertisements such as pop-up ads that can interfere with the overall browsing experience of the user and they also block website trackers that can expose the user\'s exact location.   Brave Software is just like any other open web browser it has the same interface for web navigation, browsing, and watching videos but perhaps its biggest difference against other web browsers is its ability to disable all advertisement whether in a form of pop-up or video advertisement that usually take 30 - seconds to 1 minute that can irritate the user due to the repetitive advertisement that interferes with the watching time. All of these are being blocked by Brave Software making it the best web browser to use for people who want to have privacy and peace of mind.',
                'logo' => asset('/img/logo/50x50/brave_50x50.png'),
                'image_1' => asset("img/featured/brave-browser.png"),
                'video_1' => "",
                'link_1' => 'https://brave.com',
                'platforms' => 'windows,mac,ios,android,linux,ubuntu',
                'publisher_slug' => 'brave',
                'entity_type' => 'software',
                "tags" => ["web browser"]
            ],
            [
                'title' => 'OperaGX',
                'slug' => 'opera-gx',
                'description' => 'The OperaGX browser is going to change how people view the internet and gaming. The gaming advantages are numerous, which will appeal to those in the know. The browser actually sets limits on CPU usage, which enhances the experience for the people. OperaGX is perhaps the leader when it comes to great new system ideas. Their updates are frequent, so wait to see what the team will introduce next for users.  It is easy to get started with the OperaGX browser. Just install according to the instructions which were provided. Think about the development team and what they can do next. The effort will pay off and the browser will work just fine. See what the team is doing and read updates from them via their blog.',
                'logo' => asset('/img/logo/opera-gx.svg'),
                "image_1" => "https://i.ytimg.com/vi/A0yMbbrzyeY/maxresdefault.jpg",
                'link_1' => 'https://opera.com/gx',
                'platforms' => 'windows,mac',
                'publisher_slug' => 'opera',
                'entity_type' => 'software',
                "tags" => ["web browser"]
            ],
            [
                'title' => 'Yandex Browser',
                'slug' => 'yandex-browser',
                'description' => 'Yandex browser is a free and easy-to-use web browser developed by Yandex. Its initial release was on 1st October 2012 and its stable release was throughout 2021 on different platforms. It is written in C++ and Javascript with availability in 14 languages. This browser can be used in Windows, macOS, Android, iOS, and Linux operating systems. The Main office is located in Moscow.  Yandex has proved to be one of the best and easy use browsers in recent times and has been compared to Google Chrome in every aspect. The main feature of this browser is the multiple security types it has. DNS spoofing system protects every aspect of security like passwords and files from theft. It also has wi-fi protection system and this browser is the first-ever to have DNSCrypt technology that encrypts DNS traffic. Apart from that, it also has an adblocker, app and extension management, mouse gestures, text wrapping, blink engine, integrated PDF viewer, and support for Chrome extensions.  With a lot of similar features, Chrome has and few other additional features, the Yandex browser has become very popular and has more than 84 million users in Russia alone. Anyone can use this browser due to its ease of use and user-friendly features.',
                'logo' => asset('/img/logo/yandex.browser.png'),
                "image_1" => asset("img/featured/yandex-browser.avif"),
                'link_1' => 'https://opera.com/gx',
                'platforms' => 'windows,mac',
                'publisher_slug' => 'opera',
                'entity_type' => 'software',
                "tags" => ["web browser"]
            ],
            [
                'title' => 'Maxthon Browser',
                'slug' => 'maxthon-browser',
                'description' => 'Formerly known as MyIE2, the Maxthon browser was developed by Maxthon International Ltd and had its initial release in 2002 before going for a stable release from 2014 to 2021 on different platforms like Linux, Windows phone, iOS, Mac, Android, and Windows. The software is available in 53 languages and it has offices in China and USA.  This web browser can be used on many different platforms, is fast, and is very user-friendly. It only displays genuine ads for the users. One of the best features of this browser is it works as a cloud-based browser where all the platforms are interlocked with each other and you can view the content you saved on any platform and anywhere you want. It has an auto-brightness system for the night and dim light reading. It also synchronizes the phone and computer browser to other different platforms. It has split-screen browsing, RSS reader, customizable Skinz, Ad hunter to block unwanted ads, tabbed document interface to restore webpage, programmable mouse gestures, built-in Flash, Java, and ActiveXblocking capability and it also supports Internet Explorer plugins.  This browser is safe to use and can be used by anyone in the world. Currently, more than 670 million users are using this browser as their default browser.',
                'logo' => asset('/img/logo/maxthon-cloud-browser.png'),
                "image_1" => asset('img/featured/maxthon.png'),
                'link_1' => 'https://www.maxthon.com/',
                'platforms' => 'windows,mac,linux',
                'publisher_slug' => 'opera',
                'entity_type' => 'software',
                "tags" => ["web browser"]
            ],
            [
                'title' => 'Dolphin Browser',
                'slug' => 'dolphin-browser',
                'description' => 'Dolphin browser is a free-to-use platform that was developed by MoboTap.Inc is a subsidiary of Changyou.com Limited. It can be used in Android and iOS operating systems and its stable release was on 24th November 2020 for iOS and on 12th August 2021 for Android. Changyou bought 51% of the company\'s stake for 91 million in 2014.  Dolphin browser is one of the first to introduce multi-touch gestures for android. You can use the voice search feature by only shaking the phone. It also has built-in functionality to save content and has sync support for both platforms. One unique feature is, it has flash content for android. Dolphin also offers a tabbed browser and ad-on support for more features. You can change to Jetpack mode anytime you want to speed up the browser. With the private mode option activated, it won\'t record your browsing history and any personal data. It also displays your content in a magazine style for a better view. The browser has a multitouch pinch zoom option, incognito browsing, and ad block features.  Anyone can use the Dolphin browser with iOS and Android phones. Currently, there are over 50 million users in over 200 countries that are using this browser.',
                'logo' => asset('/img/logo/dolphin-browser.png'),
                "image_1" => asset('img/featured/dolphin-browser.jpg'),
                'link_1' => 'https://dolphin.com/',
                'platforms' => 'android,ios',
                'publisher_slug' => 'opera',
                'entity_type' => 'software',
                "tags" => ["web browser"]
            ],
            [
                'title' => 'Puffin Browser',
                'slug' => 'puffin-browser',
                'description' => 'Puffin Browser is developed by an American mobile technology company called CloudMosa, whose founder is Shioupyn Shen. It is a subscription-based web browser that you can download for free from Google, but for which you have to pay a monthly subscription.  It was first released in 2010 and uses encrypted cloud servers to process content, which makes it faster than processing on local devices. However, when you browse the Internet using Puffin Web Browser, you will see the IP address of the cloud server on the website and thus Puffin Browser is treated as a proxy server only.  It comes with Adobe Flash Player, but it was later discontinued due to security issues. It also includes virtual trackpad, gamepad and on-screen keyboard features.  One of the best features of Puffin Browser is that it is extremely secure and perfect for private browsing. Besides, it has a low data consumption. Even if you are browsing on a public network, your online browsing will not be recorded by Puffin Browser. Since the traffic between the app and the browser is encrypted, you are protected from hackers and can have complete peace of mind.',
                'logo' => asset('/img/logo/puffin-browser.png'),
                "image_1" => asset('img/featured/puffin-browser.png'),
                'link_1' => 'https://dolphin.com/',
                'platforms' => 'android,ios',
                'publisher_slug' => 'opera',
                'entity_type' => 'software',
                "tags" => ["web browser"]
            ],
            [
                'title' => 'CM Browser',
                'slug' => 'cm-browser',
                'description' => 'CM Browser is a powerful web browser design for an Android device, it was developed by Cheetah Mobile and can be downloaded from the google play store, it has one of the fastest web browsing capabilities perfect for people who want to browse the web as fast as possible. But on its initial launch, it had not performed as expected due to compatible issues of Android devices that made the CM browser crash on multiple occasions making it unreliable on its launch date. One of its noticeable flaws in the past is its slower web browsing functions due to incompatibility with the chromium that is already been installed on Android devices, but with the update and patch systems update the entire CM Browser has been able to perform as it was originally and intended design with now being able to filter adds to give a smoother experience for its users without the hassle of watching video adds and pop up adds.',
                'logo' => asset('img/logo/cm-browser.png'),
                "image_1" => asset("img/featured/cm-browser.jpg"),
                'link_1' => 'https://www.cmcm.com/en/cm-browser',
                'platforms' => 'android',
                'publisher_slug' => 'cheetahmobile',
                'entity_type' => 'software',
                "tags" => ["web browser"]
            ]
        ], 'browser');
    }

    private
    function seedCryptocurrency()
    {

        $this->entitySeederLoop(
            [
                [
                    'slug' => 'coinbase',
                    'title' => 'Coinbase',
                    'short_description' => 'Coinbase is the world\'s largest cryptocurrnency exchange. They boast over 25 million users worldwide. They feature cryptocurrency wallets, trading, and over the counter services.',
                    'description' => 'Coinbase is a payment platform that allows you to buy, sell, hold and send Bitcoin and other cryptocurrencies. The service can be used in the same way as you use Visa or Master Card, with a few differences.  Coinbase makes it easy for you to buy, sell and send Bitcoin or other cryptocurrencies. You can use your credit cards with Coinbase too. If you don\'t have any cards or accounts, then you can still use Coinbase as a virtual wallet.  Coinbase has a simple signup process: just create an account and start using it today. It supports a variety of high-quality payment methods, including credit cards, wire transfers, and bank transfers. You can trade most altcoins on Coinbase using US dollars or your local currency. It\'s secure, so you can buy or sell without causing any transaction fees.  Coinbase has excellent customer service, which means if you have any problems Trading Bitcoin on Coinbase, they will help you out in any way they can – Instant Funds Delivery if required, and so much more.',
                    'logo' => asset('img/logo/50x50/coinbase_50x50.png'),
                    'link_1' => 'https://www.coinbase.com/join/miller_kqn',
                    'platforms' => 'windows,mac,android,ios,web',
                    'image_1' => "https://assets.coinbase.com/assets/coinbase-app-mobile.5c5291e641042e1765d724a4c2d1da74.jpg",
                    'video_1' => "",
                    'publisher_slug' => 'coinbase',
                    'entity_type' => 'software',
                    'tags' => ['Coinbase', 'Centralized Crypto Exchange', 'Exchange', 'Trading', 'Crypto']
                ],
                [
                    'slug' => 'binance',
                    'title' => 'Binance',
                    'short_description' => 'Binance is a cryptocurrency exchange that provides a platform for trading various cryptocurrencies',
                    'description' => 'Binance is a digital asset exchange where you can buy, sell or store any digital asset — Bitcoin, Ethereum, Litecoin, or Bitcoin Cash.  Binance isn’t just a place to trade, it is also an ecosystem where users can share their knowledge and experience regarding digital assets and blockchain technology.  Binance offers an advanced user experience for crypto traders that focuses on liquidity, security and ease-of-use. The exchange can be accessed through desktop applications via Binance mobile apps for iOS and for Android.  Changpeng "CZ" Zhanfei founded the exchange in July 2014 following the launch of Bancor, an Ethereum-based smart contract platform.  Binance allows you to trade between various cryptocurrencies (including Bitcoin, Ethereum and Litecoin) but also other coins such as Iota, Monero, Qtum and many others. You can also buy and sell these coins with Bitcoin.  Binance isn’t just a place to trade, it is also an ecosystem where users can share their knowledge and experience regarding digital assets and blockchain technology.',
                    'logo' => asset('img/logo/50x50/binance_50x50.png'),
                    'link_1' => 'https://accounts.binance.com/en/register?ref=19109809',
                    'platforms' => 'windows,mac,android,ios,web',
                    'image_1' => "https://img.currency.com/imgs/articles/1472xx/shutterstock_1185999847.jpg",
                    'video_1' => "",
                    'publisher_slug' => 'binance',
                    'entity_type' => 'software',
                    'tags' => ['Binance', 'Exchange', 'Trading', 'Futures', 'Centralized Crypto Exchange', 'P2P Crypto Exchange']
                ],
                [
                    'slug' => 'kucoin',
                    'title' => 'KuCoin',
                    'short_description' => 'KuCoin is a global cryptocurrency exchange for numerous digital assets and cryptocurrencies.',
                    'description' => 'KuCoin is a cryptocurrency exchange for many digital assets and cryptocurrencies, founded by Johnny Lyu in September 2017. Since then, it grew to more than 8 million users globally.   KuCoin has several advantages, including low trading fees, a wide range of coins, and a strong user base. With the lowest trading fee in the market, you do not have to pay monthly account fees.   In addition, KuCoin maintains a broad selection of cryptocurrencies, including the new ones so you can get in early. In the same way, you can trade often given its added liquidity because of user volume and you can find an active local community with its services. It caters localized services with multilingual customer service.   Earning interest in your crypto is easy on this platform. You can earn a sort of stock dividends by staking, or you can put your crypto into a loan to earn interest as a reward. Everyone can trade in it even with just an email address, as long as it is available in your country.',
                    'logo' => 'https://cdn.worldvectorlogo.com/logos/kucoin-shares.svg',//asset('img/logo/50x50/binance_50x50.png'),
                    'link_1' => 'https://www.kucoin.com/r/1w8s8',
                    'platforms' => 'windows,mac,android,ios,web',
                    'image_1' => "https://masterthecrypto.com/wp-content/uploads/2019/11/kucoin-user-guide.jpg",
                    'video_1' => "",
                    'publisher_slug' => 'kucoin',
                    'entity_type' => 'software',
                    'tags' => ['Kucoin', 'Crypto', 'Exchange', 'Trading', 'Futures', 'Centralized Crypto Exchange', 'P2P Crypto Exchange']
                ],
                [
                    'slug' => 'localbitcoins',
                    'title' => 'LocalBitcoins',
                    'short_description' => 'LocalBitcoins is a person-to-person bitcoin trading site. Escrow protects both buyer and seller by keeping the bitcoins safe until the payment is done and the seller releases bitcoins to the buyer.',
                    'description' => 'LocalBitcoins is a platform for bitcoins to be purchased and sold.  The idea behind this is that you can buy or sell bitcoins directly in your local currency and get a whole lot of access to people who actually want to be in contact with you. The whole idea is that you are earning money from borrowers, who will send you money when they need it but otherwise won’t pay you any interest.  LocalBitcoins has some advantages over other exchanges. It is a decentralized exchange, meaning that it does not require users to have an account with any company or service. This means that there is no need for them to register and keep track of their identities, keys, and private keys. Although this is not an advantage in terms of security, it can be important if you want to remain anonymous while trading on LocalBitcoins.  LocalBitcoins also allows users to buy and sell bitcoins without the fear of being tracked down by law enforcement. They do not require users to obtain a government-issued ID or provide any sensitive data.',
                    'logo' => "https://cdn.worldvectorlogo.com/logos/localbitcoins-1.svg",
                    'link_1' => 'https://localbitcoins.com/?ch=3may',
                    'platforms' => 'windows,mac,android,ios,web',
                    'image_1' => asset("img/featured/localbitcoins.png"),
                    'video_1' => "",
                    'publisher_slug' => 'localbitcoins',
                    'entity_type' => 'software',
                    'tags' => ['Exchange', 'P2P Crypto Exchange']
                ],
                [
                    'slug' => 'coinmama',
                    'title' => 'CoinMama',
                    'short_description' => 'CoinMama is a financial service that makes it fast, safe and fun to buy digital currency, anywhere in the world.',
                    'description' => 'CoinMama specializes in cryptocurrency exchange and is one of the first to support purchasing Bitcoin using debit and credit cards. It is also the first company to be integrated with Apple Pay and has expanded to other cryptocurrencies like Ethreum and Litecoin. It was founded by Nimrod Gruber, Laurence Newman, and Ilan Schuster in 2013. Although it was registered in Slovakia, it is currently operating from Ireland to over 2.5 million users from over 190 countries.  Through this platform, you can purchase cryptocurrency or invest in bitcoin. Although CoinMama is the key to the trading of cryptocurrency here, it will never hold customer funds and payment info. Rather it will send the fund directly to your personal wallet and that is why this platform is one of the safest out there. Apart from Apple Pay, credit, and debit card, it also has payment methods like Faster Payments, Fedwire, SWIFT, and Sofot. It has some great features like good customer support, fast verification, high spending limit, instant delivery, and the best part is, easy to use. CoinMama also offers rewarding affiliate programs.  To use this platform you must be at least 18 years old and must be verified through your personal identification. CoinMama serves all over the world with exception of some countries like Iran, North Korea, Syria, and Somalia. This platform is also restricted to 2 US states, Hawaii and New York.',
                    'logo' => "https://logo.clearbit.com/coinmama.com",
                    'link_1' => 'https://go.coinmama.com/visit/?bta=52479&brand=coinmama',
                    'platforms' => 'windows,mac,android,ios,web',
                    'image_1' => "https://www.coinmama.com/blog/wp-content/uploads/2019/05/Buy-Crypto-on-Coinmama.png",
                    'video_1' => "",
                    'publisher_slug' => 'coinmama',
                    'entity_type' => 'software',
                    'tags' => ['CoinMama', 'Crypto Trading', 'Exchange', 'Trading', 'Centralized Crypto Exchange']
                ],
                [
                    'slug' => 'kraken',
                    'title' => 'Kraken',
                    'short_description' => 'As one of the largest and oldest Bitcoin exchanges in the world, Kraken is consistently named one of the best places to buy and sell crypto online.',
                    'description' => 'Founded by Jesse Powell in July 2011, Kraken is a cryptocurrency exchange that provides spot and futures trading between digital assets, including Bitcoin, Ethereum, Litecoin, Ripple, and others.   The goal of the company is to speed up the spread of cryptocurrency. With that, people across the world will not be left behind and will achieve financial freedom.   It has professional charting tools for advanced traders to take advantage of. It also includes advanced trading tools and order systems such as leverage and margin trading.   In terms of customer service, Kraken supports its users 24/7 through live chat. As of last year, it is available in 177 countries, including 48 states in the US, and lists almost 100 cryptocurrencies to choose upon.   It is also connected with Bloomberg and TradingView. With that, it gains popularity within the crypto trading community. Traders can now access relevant data within Kraken and its partners through news, and other virtual currency introduction.',
                    'logo' => "https://res-2.cloudinary.com/crunchbase-production/image/upload/c_lpad,h_256,w_256,f_auto,q_auto:eco/nyp3ijjygkdk40p1yjxs",
                    'link_1' => '//r.kraken.com/a1L6Oj',
                    'platforms' => 'windows,mac,android,ios,web',
                    'image_1' => "https://futures.kraken.com/assets/images/platform.png",
                    'video_1' => "",
                    'publisher_slug' => 'kraken',
                    'entity_type' => 'software',
                    'tags' => ['Crypto Trading', 'Exchange', 'Trading', 'Margin Trading', 'Centralized Crypto Exchange']

                ],
                [
                    'slug' => 'gemini',
                    'title' => 'Gemini',
                    'short_description' => 'Gemini is a regulated cryptocurrency exchange, wallet, and custodian that makes it simple and secure to buy bitcoin, ether, and other cryptocurrencies.',
                    'description' => 'Gemini is a trading platform that aims to help users with their trading needs. Gemini combines the best of online stock markets, foreign exchange and trend following with a global banking infrastructure to allow its clients to trade across borders.  Gemini has its roots in the early days of the Bitcoin exchange markets when many investors could not buy or sell directly with fiat currencies. Instead, they had to rely on third-party providers such as Coinbase to facilitate their transactions for them.  As exchanges grew more popular, Gemini provided a simple and safe way for retail investors to trade directly from their bank accounts with minimum risk.  With Gemini, buying and selling Bitcoins on the spot is safe and easy — they even offer an app for mobile devices! They are also creating new ways for users to easily diversify their investment portfolios by pairing Etherium with other cryptocurrencies that can be traded against each other.  The platform offers very high levels of liquidity — and it allows anyone who wants to invest in cryptocurrency at all levels of sophistication and knowledge to do so without incurring any transaction costs whatsoever.',
                    'logo' => "https://seeklogo.com/images/G/gemini-logo-6243D2916D-seeklogo.com.png",
                    'link_1' => 'https://gemini.com/',
                    'platforms' => 'windows,mac,android,ios,web',
                    'image_1' => "https://www.gemini.com/static/images/active-trader/ActiveTrader_Performance.png",
                    'video_1' => "",
                    'publisher_slug' => 'gemini',
                    'entity_type' => 'software',
                    'tags' => ['CoinMama', 'Crypto Trading', 'Trading', 'Centralized Crypto Exchange']
                ],
                [
                    'slug' => 'paxful',
                    'title' => 'Paxful',
                    'short_description' => 'Paxful is the leading peer-to-peer cryptocurrency marketplace where buyers and sellers are connected for business. Having over 300 payment methods available on Paxful makes it incredibly easy to find suitable offers.',
                    'description' => 'Paxful is a free-to-use platform to buy and sell bitcoin. Apart from bitcoin, they also sell and buy Ethereum and Tether. The platform was founded by Artur Schaback and Ray Youssef in 2015. Its headquarters is located in New York and its branch offices are located in Estonia, the UK, Dubai, Philipines, and St Petersburg. They currently have over 400 employees and growing.  One of the best features of Paxful is they have over 350 ways to buy and sell bitcoin like bank transfers, online wallets, cash payments, discounted gift cards, digital currencies, and debit/credit cards. Paxful is very safe since it uses the Escrow system for all of its transactions. Escrow is a system that will protect the money in case a scammer is detected. They also have a dispute management system that will step in anytime there are issues between the sellers and buyers. The platform provides an encrypted private messaging system for your convenience. You can also make extra income by becoming a vendor and doing trading or in their affiliate program. After some successful trade, you can withdraw money from Paxful using Paypal, Western union, skrill, or perfect money.  To use Paxful you should be at least 18 years old and must have at least one ID verification. Although we are growing worldwide, there are still some banned countries like North Korea, Somalia, Iran, Iraq, and Libya. Join Paxful now and become a part of 6 million happy customers of this platform.',
                    'logo' => asset('img/logo/paxful.jpg'),
                    'link_1' => 'https://paxful.com/register?r=KmdA76bgEkV',
                    'platforms' => 'windows,mac,android,ios,web',
                    'image_1' => asset('img/entity_images/paxful/paxful-homepage.png'),
                    'video_1' => "",
                    'publisher_slug' => 'paxful',
                    'entity_type' => 'software',
                    'tags' => ['P2P Crypto Exchange', 'Giftcard Exchange']
                ],
                [
                    'title' => 'ByBit',
                    'short_description' => 'Buy and sell crypto seamlessly at the best available rate with our competitive market liquidity.',
                    'description' => 'ByBit is a trading platform for Cryptocurrency derivatives. There are 3 types of contracts you can buy and 5 other cryptocurrencies that you can trade-in. ByBit was founded by Ben Zhou in 2018 and its headquarters is in Singapore. This platform has more than 3 million users worldwide and growing every day.  On this platform, you can trade, buy, sell, and mine cryptocurrency. ByBit is very safe since it uses an HD cold wallet system and multiple authentication layers that guarantee the safety of the fund. The platform support traders in 13 languages. It has very high leverage up to 100x, has low internal fees, and you can buy cryptocurrency using debit or credit cards. The withdrawal process is very safe since it does not support any fiat transaction and only uses transactions from one wallet to another cryptocurrency wallet. They also provide a VIP program where you will be assisted by a personalized ambassador. You can also earn extra income through their affiliate and referral program. ByBit provides a mobile app version of the platform and has the same full functionality as the desktop version. One of the best things about ByBit is it can handle 100,000 transactions per second and have no server downtime.  The platform is truly user-friendly and any beginner with knowledge in trading can use it. The verification will be done in 5 minutes but you need to be at least 18 years old. Their service is restricted in several countries like Cuba, Iran, Syria, North Korea, and Mainland China.',
                    'logo' => asset('img/logo/bybit.jpg'),
                    'link_1' => 'https://www.bybit.com/register?affiliate_id=18270&group_id=0&group_type=1',
                    'image_1' => asset('img/featured/bybit.png'),
                    'video_1' => '',
                    'slug' => 'bybit',
                    'platforms' => 'web,android,ios',
                    'publisher_slug' => 'bybit',
                    'entity_type' => 'software',
                    'tags' => ['Centralized crypto exchange', 'Crypto Exchange', 'crypto trading', 'futures trading'],
                ],
                [
                    'title' => 'LocalCoinSwap',
                    'short_description' => 'Buy BTC, ETH, DOT, USDT, and more cryptos worldwide using 300+ payment methods.',
                    'description' => 'Buy BTC, ETH, DOT, USDT, and more cryptos worldwide using 300+ payment methods.',
                    'logo' => asset('img/logo/localcoinswap.png'),
                    'link_1' => 'https://localcoinswap.com/?rc=F7E1E5E2',
                    'image_1' => asset('img/featured/localcoinswap.png'),
                    'video_1' => '',
                    'slug' => 'localcoinswap',
                    'platforms' => 'web',
                    'publisher_slug' => 'localcoinswap',
                    'entity_type' => 'software',
                    'tags' => ['Crypto Exchange', 'P2P Crypto Exchange', 'Giftcard Exchange'],
                ]

            ], "cryptocurrency-exchange"
        );
        $this->entitySeederLoop(
            [
                [
                    'slug' => 'metamask',
                    'title' => 'Metamask',
                    'short_description' => 'Heralded as one of the leading multi-chain wallets and Defi gateways, Coin98 is an excellent alternative.',
                    'description' => 'Metamask is a browser-based tool that allows users to create, send, and receive untraceable transactions in the bitcoin world. It has been around since November 2014 and is free to use.  Metamask operates in the same way that other cryptocurrency wallets, such as Coinomi or Ledger Nano S, do: by using a “private key” which is your password-protected web wallet address, accessed via a password . Users have full control over their keys and can perform any transaction on Metamask.  Unlike other wallets with no access control , Metamask does not store your private keys directly on your computer; instead it stores them on servers that are geographically isolated from your computer. This prevents any damage done to the computer from being replicated across multiple computers. This makes it virtually impossible for hackers to steal your coins if they manage to break into one of these servers — but you can still activate two factor authentication on Metamask if you want additional security measures like two-factor authentication.',
                    'logo' => asset('https://lh3.googleusercontent.com/QW0gZ3yugzXDvTANa5-cc1EpabQ2MGnl6enW11O6kIerEaBQGOhgyUOvhRedndD9io8RJMmJZfIXq1rMxUsFHS2Ttw=w128-h128-e365-rj-sc0x00ffffff'),
                    'link_1' => 'https://metamask.io',
                    'platforms' => 'windows,mac,android,ios,web',
                    'image_1' => "https://assets.coinbase.com/assets/coinbase-app-mobile.5c5291e641042e1765d724a4c2d1da74.jpg",
                    'video_1' => "",
                    'publisher_slug' => '',
                    'entity_type' => 'software',
                    "tags" => ["cryptocurrency wallet"]
                ],
                [
                    'slug' => 'coin98',
                    'title' => 'Coin98 Wallet',
                    'short_description' => 'Coinbase is the world\'s largest cryptocurrnency exchange. They boast over 25 million users worldwide. They feature cryptocurrency wallets, trading, and over the counter services.',
                    'description' => 'Coin98 wallet is the number one multi-chain, non-custodial wallet, and De-Fi gateway. Developed by Coin98 Labs in 2020, the product is available as a web and mobile app for IOS and android. It seamlessly connects users to the digital currency world safely and securely. As the wallet is non-custodial, users have complete control over their money.  Although many Crypto wallets exist, most of them lag on security grounds. Coin98 wallet outsmarts others in this respect by ensuring better protection through multiple approaches such as TouchId, FaceID, or traditional passwords. In addition to this, it has a feature-rich add-on. This specific addition allows you to manage multiple portfolios and stay updated with the latest market trends.  Coin98 wallet provides convenient, fast, and secure processes of sending, storing, and receiving crypto payments on 21 blockchains. Popular blockchain names include Ethereum, Binance Smart Chain, Solana, and many others. The wallet is expected to add more blockchains in the coming years to attain its goal of De-Fi mass adoption.',
                    'logo' => asset('https://lh3.googleusercontent.com/-9HOHY2oGbRA8KVhPbN-FyIX0RHjvVPLzR3Gw1ESSIPzZk91Pj9riWWsR2IWQrDkcVSGW8OgBOzeMA7_xTF_7xm2=w128-h128-e365-rj-sc0x00ffffff'),
                    'link_1' => '//coin98.com',
                    'platforms' => 'windows,mac,android,ios,web',
                    'image_1' => asset("img/featured/coin98-wallet.png"),
                    'video_1' => "",
                    'publisher_slug' => '',
                    'entity_type' => 'software',
                    "tags" => ["cryptocurrency wallet"]
                ],
                [
                    'slug' => 'xdefi',
                    'title' => 'XDefi Wallet',
                    'short_description' => 'Get control of your funds and data using XDeFi wallet.',
                    'description' => 'XDEFI Wallet is a popular multi-chain browser extension. It’s available on Brave (Firefox) and Chrome. Founded in 2020 by David Phan and Emile Dubie, the wallet aims to serve DeFi and NFT users. This innovative product is the only wallet in the world with integrations on Ethereum, THORchain, Terra, and various EVM networks.  Best of all, the XDEFI Wallet is a decentralized/non-custodial wallet. That means users have full control over their data and finances. The wallet employs enhanced security. So, you can send, store, and receive cryptocurrencies without issues. It also allows connections to decentralized applications. You can additionally swap cryptocurrencies and access De-Fi (decentralized finance) products.  The XDEFI Wallet is the fastest gateway for THORchain, Ethereum, and Terra. It’s engineered for the multi-chain era and currently allows connections to nine blockchains. Popular blockchain names include THORchain, Ethereum, Polygon, Binance Chain, and Bitcoin. The wallet aims to add more blockchains soon.',
                    'logo' => asset('https://lh3.googleusercontent.com/d5I4qg1c3iwPSJxylpAV4dWX5f34DfT_eLz16ruDWOtOqOKdM_g552ZYCzpEoacN6PnGYGbAu84_96M3sXZdviAP3A=w128-h128-e365-rj-sc0x00ffffff'),
                    'link_1' => 'https://www.xdefi.io/',
                    'platforms' => 'windows,mac,android,ios,web',
                    'image_1' => asset("img/featured/xdefi-wallet.png"),
                    'video_1' => "",
                    'publisher_slug' => '',
                    'entity_type' => 'software',
                    "tags" => ["cryptocurrency wallet"]
                ],
                [
                    'slug' => 'mathwallet',
                    'title' => 'Math Wallet',
                    'short_description' => 'Math Wallet identifies itself as the ultimate MetaMask alternative, considering that it expands on its core features. ',
                    'description' => 'MathWallet is one of the multi-chain platforms that offer support for over 60 blockchains such as BinanceChain, Solana, Filecoin, Polkadot, ETH, BTC, etc., and currently has attracted over 1.2 users globally. The app of the platform is available for both Android and iOS users. It is usable for sending and receiving SOL tokens. Some key features with this platform are; ease to send tokens, Comes up with fully client-side wallets, and It supports all types of DeFi DApps.  In other words, Math Wallet is a cross-chain and multi-chain blockchain hub for storing assets. The main investors that the platform boasts include; NGC Ventures, Multi-coin Capital, Fundamental Labs, Binance Labs, Alameda Research, and Fenbushi. The app can be downloaded from Google Play Store and Apple Store to be able, to visually see the Solana environment using your mobile device. Remember that Math Wallet is just an extension wallet that can accommodate multi-chain DeFi DApps.',
                    'logo' => asset('https://doc.mathwallet.org/images/logo.svg'),
                    'link_1' => 'https://mathwallet.org/en-us/',
                    'platforms' => 'windows,mac,android,ios,web',
                    'image_1' => asset("img/featured/math-wallet-crypto.png"),
                    'video_1' => "",
                    'publisher_slug' => '',
                    'entity_type' => 'software',
                    "tags" => ["cryptocurrency wallet"]
                ],
                [
                    'slug' => 'keplr',
                    'title' => 'Keplr',
                    'short_description' => 'Keplr is the Cosmos ecosystem\'s browser wallet.',
                    'description' => 'Keplr Wallet is one of the leading wallets for the Cosmos ecosystem which allows you to manage all your tokens using one wallet. It was launched back in October 2021 by Chinapsis.   This browser extension wallet is simple and easy to use by everyone. At the moment, it supports CertiK, Agoric, Bostrom, Akash, Sifchain, and many others. For you to keep all your transactions private and safe, it is ideal to perform them offline.   The private keys are usually encrypted and stored in your computer safely.   It features a vote on governance proposals, token supports, and so on. Therefore, if it is your first time using this app, you do not need to worry about the safety of your data because it does not collect, log or store your data.   Each time you need to explore any blockchain applications on Cosmos ecosystem or any other, this app assures you of more convenient operations.',
                    'logo' => asset('https://lh3.googleusercontent.com/_-md6h0K4pTgAiYm5PBsInyxf6w0tnzBOIwWWT5UO1e3Icz21puV_EO86hPzbNLgZ2B6RuF0bAe-dctBzl2tEc2k=w128-h128-e365-rj-sc0x00ffffff'),
                    'link_1' => 'https://www.keplr.app/',
                    'platforms' => 'windows,mac,android,ios,web',
                    'image_1' => asset("img/featured/keplr-wallet.jpg"),
                    'video_1' => "",
                    'publisher_slug' => '',
                    'entity_type' => 'software',
                    "tags" => ["cryptocurrency wallet"]
                ],
                [
                    'slug' => 'phantom',
                    'title' => 'Phantom Wallet',
                    'short_description' => 'Phantom Wallet is focused on the Solana blockchain and has earned its reverence as the number one wallet for Solana/Serum-based transactions. ',
                    'description' => 'Phantom Wallet is a free, open-source Solana wallet developed by Carbonite. It allows you to store your private keys online. This can be useful if you are traveling and want to keep track of your coins over time.  Phantom Wallet also offers a “Bitshares Wallet” feature that lets you directly connect to Bitshares (BSR) through a web wallet. This is great for people who prefer BSR as their primary currency. Anyone who has used Bitshares before will know what I am talking about, so this is not an unfamiliar concept.  Phantom Wallet includes some beneficial features such as an in-wallet buy and sell function, support for trading cryptocurrencies, and the ability to send Bitcoin and Ether from the wallet without setting up an exchange account.  The way it works is that it creates an internet connection that can be used to make purchases. When you are purchasing on the web, Google ensures your account is safe and ensures that you do not lose money due to fraudulent transactions.',
                    'logo' => asset('https://lh3.googleusercontent.com/VhRtNjTWTFzfEEcVzy8EUrWahuLI4vAJFqURDLynZq2Xm-b6n9wr2k-LMRtWhIwqTNJLfORSWwqkYwMBdXRQ4MKA0w=w128-h128-e365-rj-sc0x00ffffff'),
                    'link_1' => 'https://phantom.app/',
                    'platforms' => 'windows,mac,android,ios,web',
                    'image_1' => asset("img/featured/phantom-wallet.png"),
                    'video_1' => "",
                    'publisher_slug' => 'coinbase',
                    'entity_type' => 'software',
                    "tags" => ["cryptocurrency wallet"]
                ],
            ], "cryptocurrency-wallet"
        );
    }

    private
    function seedDevelopment(): void
    {
        $this->entitySeederLoop([
            [
                'title' => 'Clappia',
                'slug' => 'clappia',
                'description' => 'Clappia is an online development application that allows professionals to create business process apps without any code. Clappia was created in India in 2017.  Almost every business in this modern age needs an app to facilitate its processes. Clappia makes it easy for any business owner to create their own app.  Clappia comes with a few templates to get started such as order or inventory tracking forms. These templates contain text forms that can be easily labeled and imported into your app.  If you don\'t want to use a template, you can design your app from scratch using the built-in editor. App design becomes a breeze with this tool as you can drag and drop various items such as text fields, charts, tables, sliders right on the screen. The coding is already taken care of by the algorithm on the back end.  Clappia starts at $5 per month and includes a 30-day free trial.',
                'logo' => asset('img/logo/clappia.png'),
                'link_1' => 'https://clappia.com/',
                'platforms' => 'web',
                'image_1' => "",
                'video_1' => "",
                'publisher_slug' => 'clappia',
                'entity_type' => 'software',
                "tags" => ["development", "no code"]
            ],
            [
                'title' => 'ActionDesk',
                'slug' => 'actiondesk',
                'description' => 'Actiondesk is a web application that organizes databases in order to more readily analyze data. It was created in 2020 by Valentin Lehuger and Jonathan Parisot when they created a start-up that had an influx of preorders and needed to be able to quickly access their customers\' data in order to fulfill the orders.  Actiondesk makes it easy to access any part of a large database without having to use SQL. It\'s perfect for any start-up that is already familiar with Microsoft Excel or Google Sheets. Any set of data can be instantly accessed by simply asking a question to the application\'s powerful AI.  It requires no code set up and multiple team members can collaborate on the same set of data at the same time for maximum efficiency. For even deeper analysis, the newly created databases easily integrate into Salesforce, Stripe, SQL, and a host of other enterprise applications.  Actiondesk starts at $15 per month, per user with a free 14-day trial.',
                'logo' => asset('img/logo/actiondesk.svg'),
                'link_1' => 'https://actiondesk.io/',
                'platforms' => 'web,windows,linux,mac',
                'image_1' => "",
                'video_1' => "",
                'publisher_slug' => 'actiondesk',
                'entity_type' => 'software',
                "tags" => ["development", "database", "BI"]
            ],

        ], "development");
        $this->entitySeederLoop([
            [
                'title' => 'Visual Studio 2019',
                'description' => 'Microsoft Visual Studio is an integrated development environment (IDE) that you can use each time you need to develop programs, web services, web apps, mobile apps, and many other websites. Visual Studio 2019 has the best tools and services that are very useful for any kind of application, developer, and platform. So, if you are a newbie or used to it, there are many things that you will like about the app. This was released by Microsoft. The latest version had several features and improvements that assure you of a quick execution and better productivity. You can download it for free from Visual Studio 2019 Preview. This makes it so convenient for you to run any other edition of visual studio alongside this version. For better team and developers improvement, it features better search, debugger improvement, one-click code cleanup, live share, and many more. Therefore, if you are looking forward to improving your collaborative workflows, Visual Studio 2019 is all that you ever need.',
                'logo' => asset('img/logo/50x50/microsoft-visual-studio_50x50.png'),
                'slug' => 'visual-studio',
                'link_1' => 'https://visualstudio.microsoft.com/',
                'platforms' => 'mac,linux,windows',
                'image_1' => "https://visualstudio.microsoft.com/wp-content/uploads/2019/03/codelens-Still-1200.jpg",
                'video_1' => "",
                'publisher_slug' => 'microsoft',
                'entity_type' => 'software',
                "tags" => ["microsoft", "ide", "coding", "development"]
            ],
            [
                'title' => 'Visual Studio Code',
                'short_description' => 'Microsoft\'s free source-code text editor for Windows, Mac and Unix',
                'description' => 'Visual Studio Code is a free cross-platform code editor for the .NET platform. It was created by the same team that created the popular Team Foundation Server.It has features such as code folding and tabbed editing.  Visual Studio Code is a cross-platform development environment (IDE). It can run Node.js applications, but it can also be used with other languages such as C#, C++, or Java.  Visual Studio Code has many built-in tools that are specifically designed to support cross-platform development and testing. The UI of Visual Studio Code looks very similar to Microsoft’s Visual Studio software suite and also features some similarities like syntax highlighting and code completion features with IntelliSense.  An important feature that VS Code can do is provide a simple, stable command-line interface that allows you to perform common tasks with one keystroke.If you need to run a remote command on your machine, VS Code provides this functionality through its built-in terminal emulator.',
                'logo' => asset('img/logo/50x50/visual-studio-code_50x50.png'),
                'slug' => 'visual-studio-code',
                'link_1' => 'https://visualstudio.microsoft.com/',
                'platforms' => 'mac,linux,windows',
                'image_1' => "https://stevenbart.com/storage/2020/02/microsoft-visual-studio-2019.png",
                'video_1' => "",
                'publisher_slug' => 'microsoft',
                'entity_type' => 'software',
                "tags" => ["microsoft", "ide", "coding", "development"]
            ],
            [
                'title' => 'IntelliJ IDEA',
                'short_description' => 'JetBrain\'s IDE, the best Java IDE on the market.',
                'description' => 'IntelliJ IDEA is a popular IDE (integrated development environment). Written in Java, it’s meant for developing software. The product was developed in January 2001 by JetBrains. It’s available for use as an Apache 2 Licensed Edition and proprietary Commercial Edition.  IDE offers features such as code completion by analyzing code navigation and the context, which lets users directly jump to a declaration or a class in the code, code debugging, code refactoring, and Linting. Plus, the framework provides options to mend inconsistencies through suggestions. The IntelliJ IDEA presents integration with packaging/build tools such as Bower, Grunt, SBT, and Gradle. it supports various version control systems such as Mercurial, GIT, SVN, and Perforce.  Users can access databases such as Oracle, Microsoft SQL Server, SQLite, MySQL, and PostgreSQL from the IDE framework in the Ultimate Edition. The beauty of the framework is it supports plug-ins. Users can add new functionality to the Framework. You can download and install plug-ins from IntelliJ’s plug-in repository or through the search and install option of IDE’s inbuilt plug-in. The IntelliJ IDEA Framework supports various languages such as CSS, HTML JavaSQL, JavaScript, and others for enhanced software development.',
                'logo' => asset('img/logo/50x50/intellij-idea_50x50.png'),
                'slug' => 'intellij-idea',
                'link_1' => 'https://www.jetbrains.com/idea/',
                'platforms' => 'mac,linux,windows',
                'image_1' => "https://blog.jetbrains.com/wp-content/uploads/2019/03/idea-DarkPurpleTheme.png",
                'video_1' => "",
                'publisher_slug' => 'jetbrains',
                'entity_type' => 'software',
                "tags" => ["java", "ide", "coding", "development"]
            ],
            [
                'title' => 'Eclipse',
                'short_description' => 'The world\'s most famous Java IDE.',
                'description' => 'Eclipse is an Integrated Development Environment (IDE) that is commonly used by computer programmers. It features a base workspace and a plug-in system that enables you to set your environment. Ideally, it is written in Java therefore its main objective is to develop Java applications. You can use it to develop other applications using other programming languages such as C++, C#, Fortran, Lasso, Python, COBOL, Haskell, JavaScript, and many more. In addition, it can be used in developing documents with La Tex and other packages. Installing this application is very and only requires a few steps. Since it is a Java-based application, it will need a Java Runtime Environment(JRE)or Java Development Kit(JDK). Depending on what you want to do with the eclipse, you can choose to install any of them. For example, if you want Eclipse for Java Development, it would be wise to go for JDK. If not and you need to save your disk space then you can install JRE.',
                'logo' => asset('img/logo/50x50/eclipse_50x50.png'),
                'slug' => 'eclipse',
                'link_1' => 'https://www.eclipse.org/',
                'platforms' => 'mac,linux,windows',
                'image_1' => "https://dzone.com/storage/temp/8097581-ss-4-darkest-dark.png",
                'publisher_slug' => 'eclipse',
                'entity_type' => 'software',
                "tags" => ["java", "ide", "coding", "development"]
            ],
            [
                'title' => 'Apache NetBeans',
                'short_description' => 'Open source development IDE from Apache.',
                'description' => 'Starting as a student project in Prague, Apache Netbeans has become one of the most used integrated development environments (IDE) for Java. Its original author was Roman Stanek. Its preview release was on November 2020 and nearly 1 year later it was officially released in November 2021. It works on Windows, macOS, Linux, and Solaris operating systems with 28 available languages. In 2010 Oracle bought Apache NetBeans and made them an official Java IDE.  This software is an open-source and free IDE that can be used to develop web applications on desktop and mobile by providing wizards, editors, debugging, and templates. It not only supports coding in Java but also HTML and CSS. Using dynamic tools, the software will systematically highlight source code so that you can refactor it. NetBeans is also the first software to provide support for Java EE7, JDK 7, and JavaFX 2. To use NetBeans you need to install Java Development Kit (JDK). It has some great features like a start page with regular updates, the auto-complete function, and the ability to switch between project and file.  Apache Netbeans although easy to use, has a complex Java coding system and is not suitable for beginners. You need to have some basic Java coding knowledge to use it.',
                'logo' => asset('img/logo/50x50/apache-netbeans_50x50.png'),
                'slug' => 'apache-netbeans',
                'link_1' => 'https://netbeans.apache.org/',
                'platforms' => 'mac,linux,windows',
                'image_1' => "https://pbs.twimg.com/media/CZF2vWTUsAETj28.png",
                'video_1' => "",
                'publisher_slug' => 'apache',
                'entity_type' => 'software',
                "tags" => ["java", "ide", "coding", "development"]
            ],
            [
                'title' => 'PyCharm',
                'short_description' => 'PyCharm is a popular Python IDE from JetBrains.',
                'description' => 'PyCharm is a free, open-source, and dedicated integrated development environment (IDE) used for programming. The software was developed by a Chezh company called JetBrains. Its initial release was on the 3rd February 2010 and was officially released on 30th November 2021. It is written in Java and Python and can be used in Windows, Linux, and macOS operating systems. After the development of the original PyCharm, it went on to release a Community edition and a Professional edition with an education version.  The software has an intelligent code editor which can support platforms like Javascript, CSS, and Phyton to detect code error and fix it on the go. Its smart code navigation provides you with an easy click to switch between files and classes. It has a safe refactoring system that can introduce variables, extract method and delete or rename it. It has many easy-to-use database tools that can debug, test, and profile the coding system. It has integration with Conda, customizable UI, and an interactive Phyton console for better code completion. It supports both Phyton 2 and Phyton 3 versions.  PyCharm is currently being used by 882 companies like Trivago, Alibaba Travel, and Udemy. With its incredible and easy-to-use features, using PyCharm is suitable for all beginners.',
                'logo' => asset('img/logo/50x50/pycharm_50x50.png'),
                'slug' => 'pycharm',
                'link_1' => 'https://www.jetbrains.com/pycharm/',
                'platforms' => 'mac,linux,windows',
                'image_1' => "https://www.jetbrains.com/pycharm/img/screenshots/complexLook@2x.jpg",
                'video_1' => "",
                'publisher_slug' => 'jetbrains',
                'entity_type' => 'software',
                "tags" => ["python", "ide", "coding", "development"]
            ]
        ], 'ide');
        $this->entitySeederLoop([
            [
                'title' => 'NotePad++',
                'slug' => 'notepad-plus-plus',
                'description' => 'NotePad++ is an open source text editing software launched by DonHo in 2003. This software supports different code languages and was designed for Microsoft Windows but can also be used on Linux.  NotePad++ can be used for writing, editing and saving documents, and also for editing files that contain different language codes. It can be compared to the popular microsoft windows notepad, but Notepad++ has some extra features that can be very useful in different situations. First of all, this software identifies different language codes, providing us a clear and organised presentation of the code. If we opened the same code document on Notepad++ and Windows Notepad we would inmediately notice the huge difference between the organisation of the information in these two softwares. Furthermore, Notepad++ shows the line numbers making it much easier to work and allows us to open multiple tabs in the same window. On the other hand, this software is able to open every file no matter its extension, it won\'t open the file just when it\'s corrupt.  In conclusion, this text editor is perfect for those people and programmers who like Windows Notepad but would like to upgrade it, having some useful extra features.',
                'logo' => asset('img/logo/notepad++.png'),
                'link_1' => '',
                'platforms' => 'windows,mac,linux,web,android,ios',
                'publisher_slug' => 'notepad++',
                'entity_type' => 'software',
                "tags" => ["Text Editor"]
            ],
            [
                'title' => 'Brackets',
                'slug' => 'brackets',
                'description' => 'Brackets is a source code editor that was launched in 2017 by Adobe Systems. It is available for Windows, Linux and Mac OS and was written in JavaScript, HTML and CSS. This software is one the most common ones among the website developers,since it has multiple useful features for designing a website which makes it different and more efficient than others. Brackets gives you the choice to quickly edit the properties of a CSS file, and it also allows you to see the changes you have made on a project using the preview function, which can be very useful and comfortable as to see the progress you have already made and how it looks like. Some other interesting features of it are that it allows you to manipulate the structure of the folders or open a remotely allocated website from this software. This software is a very modern open source code editor that will allow you to work on a website in a very comfortable way, it is powerful, light and efficient at the same time.',
                'logo' => asset('img/logo/brackets.png'),
                'link_1' => '',
                'platforms' => 'windows,mac,linux,web,android,ios',
                'publisher_slug' => 'brackets',
                'entity_type' => 'software',
                "tags" => ["Text Editor"]
            ],
            [
                'title' => 'WriteMonkey',
                'slug' => 'writemonkey',
                'description' => 'Writemonkey is a free text editor for windows with a very simple and easy to use interface. This software has been specifically designed to write, in comparison with other text editors this has been created as a better choice for this task, you will definitely notice it when you open the program, since it will only show an area to start writing, leaving out many common tools for text editing.  If you run the program in window mode it will show the toolbar on the top of it, but If you run it on full screen the toolbar will disappear, removing every distraction, but you will still be able to access the tools by right clicking your mouse. This software has also some common features among the text editors such as spell check, and it also has some curiosities such as the possibility to put different sounds while writing, for example an old keyboard typing sound, which could be more inmersive for some people and make them more focused on their writing.  Writemonkey is a comfortable, quick, and easy to use program. Since it leaves out many features of a typical text editor, it is way lighter than those, which makes it work faster and more efficiently If you don\'t need to make use of that tools.',
                'logo' => asset('img/logo/writemonkey.png'),
                'link_1' => '',
                'platforms' => 'windows',
                'publisher_slug' => 'writemonkey',
                'entity_type' => 'software',
                "tags" => ["Text Editor", "Word Processor"]
            ],
            [
                'title' => 'VIM',
                'slug' => 'vim',
                'description' => 'VIM is an open-source configurable text editor for UNIX. VIM is an acronym for Vi IMproved. Its original author is Bram Moolenaar. Its initial release was on 2nd November 1991 and its stable release was on 12th December 2019. It is written in VIM script and C. It uses Unix, Linux, MS-DOS, Windows NT iOS and Android operating systems.  VIM has turned 30 and it has been improving every year. It is easy to use and you only need a few commands to complete a complex task. It is highly configurable and uses a simple text file for storage. You can extend its functionality by using multiple plugins that are available. It has multiple windows, multiple buffers and multiple tabs to support the usage of many files at once. You can repeat the command using the available recording features. It has a very low memory footprint. VIM does not have GUI but it has a separate installer called gVIM that provides it. The idea of this platform is, the mouse is slow to use instead they use one key shortcut to improve on it.  There is one week trial period for this platform. After that, you need to get a subscription to continue using it. Anyone can use this platform but it is not recommended to beginners. Usually, mid-size companies and IT-related companies use this platform.',
                'logo' => asset('img/logo/vim.png'),
                'link_1' => '',
                'platforms' => 'windows',
                'publisher_slug' => 'vim',
                'entity_type' => 'software',
                "tags" => ["Text Editor"]
            ],
            [
                'title' => 'Sublime Text',
                'slug' => 'sublime-text',
                'description' => 'Sublime Text is a source code editor that natively supports programming and markup languages. Its functionality can also be expanded with the use of plugins and be able to maintain its free software licensed in the long run.   It was developed by Sublime HQ in January 2008, 14 years ago, and can be downloaded for windows and mac users. Both of these platforms are well supported by Sublime text and they have assured their clients that it will be stable and it will not have any crash and lag problems when being used.   Most of the users of the Sublime Text can be developers and coding experts. But perhaps it is very best feature is that it is very affordable and paying for it can be done via Paypal. Overall the Sublime text software is very affordable and easy to use that even a newbie can easily understand because of its friendly user interface.',
                'logo' => asset('img/logo/sublime-text.png'),
                'link_1' => '',
                'platforms' => 'windows',
                'publisher_slug' => 'sublime-text',
                'entity_type' => 'software',
                "tags" => ["Text Editor"]
            ]
        ], "code-editor");

    }

    public
    function seedEducationReference()
    {
        $this->entitySeederLoop([
            [
                'title' => 'Khan Academy',
                'slug' => 'khan-academy',
                'description' => 'Khan Academy is an online education platform created by Salman Khan in 2006. The website now boasts 70 million users, with 2.3 of those being students. It has been said that students primarily use the said platform to help review for SAT.  The website offers around-the-clock, free education to anyone with an internet connection. Khan doesn\'t just offer video lectures on a variety of academic subjects; it also offers practice problems and quizzes tailored to each student\'s needs.  One of the best features of Khan Academy is that it breaks down complex topics into digestible pieces, making learning easier for students of all ages and levels. In addition to its impressive roster of users, Khan Academy has also been praised by experts in the field for its well-made videos, engaging exercises, and easy-to-follow explanations.  Khan Academy is quickly becoming one of the most popular online education platforms for a good reason: it\'s effective, engaging, and easy to use. Geared towards both students who are looking to review for an upcoming test and adults who want to learn something new, Khan Academy is a valuable resource for anyone looking to expand their knowledge.',
                'logo' => asset('img/logo/khan-academy.png'),
                'link_1' => 'https://www.khanacademy.com/',
                'platforms' => 'web',
                'publisher_slug' => '',
                'entity_type' => 'software',
                "tags" => ["education"]
            ],
            [
                'title' => 'Codecademy',
                'slug' => 'codecademy',
                'description' => 'Codecademy is a website that teaches people how to code web apps. It was founded in 2011 by Zach Sims and Ryan Bubinski who wanted to create an online education to teach beginners practical coding skills that will land them a job in the technology field of their choice.  Instead of teaching individual skills, Codecademy has its students select a career path first, then teaches relevant skills so that they will be ready to work in the field upon completion of the course. There are a variety of career paths a student could choose from such as Front-End Engineer, Full-Stack Engineer, Back-end Engineer, and more.  Not only does Codecademy teach relevant skills for the career path, its courses even teach students how to interview and land a job in the field of their choice.  Codecademy offers a ton of basic courses on JavaScript, Python, and more for free. Career paths start at $19.99 per month, billed annually.',
                'logo' => asset('img/logo/codecademy.png'),
                'link_1' => 'https://codecademy.com/',
                'platforms' => 'web',
                'publisher_slug' => '',
                'entity_type' => 'software',
                "tags" => ["education", "development education"]
            ],
            [
                'title' => 'Lynda',
                'slug' => 'lynda',
                'description' => 'Lynda is a website where people can advance their knowledge on many subjects. It was founded in California by Lynda Weinman. She js a multimedia professor. It\'s a good software because the tutorials and courses are taught by experts and industry leaders. The reason why this software is well known is due to the wide range of topics that it covers. It\'s an educational platform. People who might use this platform are video editors, photo shoppers, and more due to their passion of expanding their skill set. The software helps people take in information from their chosen topic and also as a way to share information from their own skill set. The software has also merged with LinkedIn Learning. The pricing plan is also very cheap. People can see this platform as a multi learning tool where one can gather in information easily. For 2022, the ratings is very high,',
                'logo' => asset('img/logo/lynda.png'),
                'link_1' => 'https://lynda.com/',
                'platforms' => 'web',
                'publisher_slug' => '',
                'entity_type' => 'software',
                "tags" => ["education"]
            ],
            [
                'title' => 'Coursera',
                'slug' => 'coursera',
                'description' => 'Coursera was founded in 2012 by two Stanford professors, Daphne Koller and Andrew Ng. It is a for-profit education technology company that offers massive open online courses (MOOCs). It initially started out as a platform for Stanford courses but has since expanded to include courses from other universities, including Yale, Princeton, and the University of Pennsylvania.  What makes Coursera unique is its range of courses. It offers over 7,000 online courses from 120 universities, including Stanford, Yale, Princeton, and the University of Pennsylvania. It also offers specializations, which are a series of courses that help students focus on a specific area of study.  Today, Coursera now offers other short courses focused on search engine optimization, digital marketing, content writing, advertising, and more.  Coursera is perfect for individuals who are looking to gain new skills or knowledge from some of the best teachers, coming from prestigious universities in the world. It offers a wide range of courses, specializations, and other short courses that can help you improve your skills. You can most Coursera\'s courses for free or get started with a paid subscription.',
                'logo' => asset('img/logo/coursera.png'),
                'link_1' => 'https://coursera.com/',
                'platforms' => 'web',
                'publisher_slug' => '',
                'entity_type' => 'software',
                "tags" => ["education"]
            ],
            [
                'title' => 'QVault',
                'slug' => 'qvault',
                'description' => 'QVault is a website that teaches students specific programming skills to land their dream job in tech. It was created in 2020 by Lane Wagner who wanted to make programming courses available and affordable to people who want to learn practical coding skills that will actually make them employable.  Getting your foot in the door with tech companies is becoming increasingly difficult in the competitive world of technology. Computer Science degrees are becoming irrelevant as many schools are charging more and more money for outdated education, and employers want to hire people who can demonstrate expertise in creating software that specifically tailors to their project or business.  QVault solves this problem by providing the most up-to-date in-house instruction on skills that will directly pertain to current processes. They even teach you interview skills that will prepare you to ace the tough interview process that many companies put candidates through today.  A free basic membership will allow you access to read all of the courses available and a sandbox to test your code. A patron membership starting at $25 per month will allow you access to more features such as code verification, certificates of completion, and a community to help each other stay focused.',
                'logo' => asset('img/logo/qvault.webp'),
                'link_1' => 'https://qvault.io/',
                'platforms' => 'web',
                'publisher_slug' => 'qvault',
                'entity_type' => 'software',
                "tags" => ["education", "development education"]
            ],
            [
                'title' => 'Pluralsight',
                'slug' => 'pluralsight',
                'description' => 'PluralSight is a software development learning platform. It was founded by Aaron Skonnard and Fritz Onion in 2004. PluralSight is used by developers, IT administrators, and other professionals to learn new technology skills or get certified.  The PluralSight platform has a library of over 6000 courses, which are all curated and updated regularly. The courses cover a range of topics including software development, IT administration, security, artificial intelligence, and more.  The company was recently acquired by LinkedIn for $400 million, making it the largest acquisition of a Utah-based company ever. Since then, PluralSight has been making big changes to its platform, including a new subscription model and the launch of Pluralsight IQ.  This newly launched feature measures your skills and gives you personalized recommendations on the courses you should take to improve. It is used by businesses, entrepreneurs, and individuals to identify gaps in their skills and future learning needs.',
                'logo' => asset('img/logo/pluralsight.png'),
                'link_1' => 'https://pluralsight.com/',
                'platforms' => 'web',
                'publisher_slug' => 'pluralsight',
                'entity_type' => 'software',
                "tags" => ["education", "development education"]
            ],
        ], "education-reference");
    }

    public
    function seedGames()
    {

    }

    private
    function seedLiveStreaming(): void
    {
        $this->entitySeederLoop([
            [
                'slug' => 'obs',
                'title' => 'OBS',
                'short_description' => 'The world\'s most popular live streaming software. Open source.',
                'description' => 'OBS is an easy-to-use software program for recording and live streaming to multiple platforms such as Twitch, YouTube, and Facebook Gaming. It requires low CPU usage which results in an effortless stream, especially if you lack a state-of-the-art computer system. Like any program, it has perks and downfalls.  It\'s been around for a while, so if you run into a jam, you\'re sure to find a ton of articles and video tutorials to help you out. It also means it will be among the first to get updates. The downside is it doesn\'t include many customization options for you to decorate your screen with for an overall theme, so if you want some variety you\'ll have to learn how to add it on your own or settle for what\'s available.  Opting for OBS really boils down to what your goal is with the service. If you seeking less lag and an easy set-up, this is it.',
                'logo' => asset('/img/logo/obs-studio.png'),
                'link_1' => '//obsproject.com',
                'platforms' => 'windows,mac,linux',
                'image_1' => asset("img/featured/obs.png"),
                'video_1' => "",
                'publisher_slug' => 'obs',
                'entity_type' => 'software',
                'tags' => ['Live Streaming Software', 'Screen Recorder']
            ], [
                'slug' => 'streamlabs-obs',
                'title' => 'StreamLabs OBS',
                'short_description' => 'An improved version of OBS, the world\'s most popular live streaming software suite.',
                'description' => 'Streamlabs OBS is a streaming service currently owned by a company named Logitech. It allows you to stream seamlessly on multiple platforms like YouTube, Twitch, and Facebook Gaming. Not only is it free but it comes with a truckload of customizable features like overlays and links for audio sources. A huge win is a built-in chatbot., which helps you maximize audience engagement. You can customize your chatbot with various commands like directing your viewers to your social media accounts or asking them questions at timed intervals. You can also limit unwanted chats and keep people from posting links by blocking unwanted words and keyphrases. You can add images, textboxes, share your screen, display the latest subscribers, donations, followers, gift subs, and more. With widgets like these, you are able to increase audience engagement, boost eye appeal for the viewers, and add your own unique flair to show off your personality.',
                'logo' => asset('/img/logo/streamlabs-obs.png'),
                'link_1' => 'https://streamlabs.com/goprime?promo=truemiller-7085-10',
                'platforms' => 'windows,mac,linux',
                'image_1' => asset("img/featured/streamlabs-obs.png"),
                'video_1' => "",
                'publisher_slug' => 'streamlabs',
                'entity_type' => 'software',
                'tags' => ['Live Streaming Software', 'Screen Recorder']
            ], [
                'slug' => 'xsplit-broadcaster',
                'title' => 'XSplit Broadcaster',
                'short_description' => 'XSplit Broadcaster is live streaming and recording software that’s designed for game developers and content creators.',
                'description' => 'Xsplit Broadcaster is a video mixing and live streaming application created by SplitMediaLabs. It’s popularly used to capture gameplay for video recording or live streaming. While Xsplit began its journey in 2009, Xsplit Broadcaster was announced in December 2010 when SplitMediaLabs stated that the service is going into public beta. Broadcaster was initially released on April 13, 2012. However, it became available to the public in January 2013.  Xsplit Broadcaster serves as a handy video mixer. It can switch between several media configurations while mixing it with various other sources such as screen regions, video camera, flash, and game capture. All these sources are mostly used to make a broadcast production for on-demand and live distribution on the net.  The latest version features enhancements in performance as well as support for new hardware devices. In November 2013, the service released another version to fix security issues concerning login that some users reported. Currently, Xsplit Broadcaster has millions of users across the world.',
                'logo' => asset('/img/logo/xsplit-broadcaster.png'),
                'link_1' => 'https://www.xsplit.com/buy?ref=joshmiller7&discount=alterliste&pp=stripe_affiliate',
                'platforms' => 'windows',
                'image_1' => asset("img/featured/xsplit-broadcaster.webp"),
                'video_1' => "",
                'publisher_slug' => 'xsplit',
                'entity_type' => 'software',
                'tags' => ['Live Streaming Software', 'Screen Recorder']
            ], [
                'slug' => 'nvidia-shadowplay',
                'title' => 'NVIDIA ShadowPlay',
                'short_description' => 'NVIDIA Shadowplay allows you to both record and stream your gameplay.',
                'description' => 'Nvidia ShawdowPlay is a recording service on a screen that is meant for the Nvidia GeForce Experience. It was succeeded by what is referred to as Nvidia Share however most people still call it ShadowPlay.   This application allows you to record all your games in a more seamless and flawless way just like Twitch and many other platforms. It comes with an overlay that is ideal for screen recording and even utilities for broadcasting.  The screen recording utility can be set to do an automatic recording continuously, thus enabling you to save the video without having to do it manually. The unit is supported by an Nvidia GTX-600 card or even higher.   We must point out also that ShadowPlay uses two different capture methods. The first one is Inband Frame Readback while the second method is Frame Buffer Capture. Basically, Nvidia was unleashed in June 2013. But its beta version was released the same year on October 28.',
                'logo' => asset('/img/logo/nvidia-shadowplay.png'),
                'link_1' => 'https://www.nvidia.com/en-us/geforce/geforce-experience/shadowplay/',
                'platforms' => 'windows',
                'image_1' => asset("img/featured/nvidia-shadowplay.webp"),
                'video_1' => "",
                'publisher_slug' => 'nvidia',
                'entity_type' => 'software',
                'tags' => ['Live Streaming Software', 'Screen Recorder']
            ]
        ], "live-streaming");
    }

    private
    function seedMusic(): void
    {
        $this->entitySeederLoop([
            /*Spotify*/
            [
                'title' => 'Spotify',
                'description' => 'Spotify is a digital music, podcast, and video streaming service that gives you access to millions of songs and other content from artists all over the world. Basic functions such as playing music are totally free, but you can also choose to upgrade to Spotify Premium.',
                'logo' => asset('/img/logo/50x50/spotify_50x50.png'),
                'slug' => 'spotify',
                'link_1' => 'https://spotify.com',
                'platforms' => 'windows,mac,ios,android,linux,ubuntu,web',
                'image_1' => "https://cdn.pocket-lint.com/r/s/1200x/assets/images/139236-apps-news-feature-what-is-spotify-and-how-does-it-workimage1-71xhfr5dgv.jpg",
                'video_1' => "",
                'publisher_slug' => 'spotify',
                'entity_type' => 'software',
                "tags" => ["music streaming", "music player", "music sharing"]
            ],
            /*iTunes*/
            [
                'title' => 'iTunes',
                'short_description' => 'iTunes was Apple\'s flagship music player application that shut down in 2009.',
                'description' => 'iTunes was created in 2001, as a way to sell and manage digital music files. It was initially created as Mac\'s default music player and eventually developed into a more sophisticated online store offering DRM-free music downloads. It\'s exclusively available on Apple devices, such as the iPod, iPhone, iPad, and Mac.  In 2003, Apple introduced the iTunes Music Store, which allowed users to purchase and download digital music files. They also allowed users to purchase and download movies, TV shows, and audiobooks. The iTunes Store later expanded to include apps, games, and books. The store was a success, and by 2014, it had sold over 35 billion songs.  Today, the iTunes Store is one of the most popular online stores in the world. It has over 575 million active users and over 60 million songs in its library. It\'s also the largest music retailer in the world. iTunes is often used during workout sessions and long drives. It has become the staple of Apple\'s ecosystem and is a major reason why their devices are so popular.',
                'logo' => asset('/img/logo/50x50/itunes_50x50.png'),
                'slug' => 'itunes',
                'link_1' => 'https://itunes.com',
                'platforms' => 'windows,mac,ios,android',
                'image_1' => "https://i2.wp.com/9to5mac.com/wp-content/uploads/sites/6/2018/03/screen-shot-2018-03-29-at-4-33-33-pm.jpg?w=2000&quality=82&strip=all&ssl=1",
                'video_1' => "",
                'publisher_slug' => 'apple',
                'entity_type' => 'software',
                "tags" => ["music streaming", "music player"]
            ],
            /*SoundCloud*/
            [
                'title' => 'Soundcloud',
                'description' => 'SoundCloud is a platform that allows creators to publish their tracks and share them with the world. Before you even get started, you need to create your SoundCloud profile.  Soundcloud provides an easy-to-use platform for your music. You can host your own Soundcloud pages and use official SoundCloud links to add them to your page. However, if you want a popular fan base, some factors play a role in getting noticed faster.  As with any other social media platform, the more followers you have on Soundcloud, your page becomes more popular. But the more followers you have on Soundcloud isn\'t everything; it\'s just one of many factors that goes into who gets noticed on Soundcloud first.  A good SoundCloud profile doesn\'t just say "I like this song" or "Hey guys! Have fun listening!" - it needs to be relatable in some way. It must be interesting and informative enough for people to want to share it with their friends or stay up late after work reading about it online. Most importantly, users must feel comfortable sharing their content there based on who they are and what they do - not based on how many followers they have got from other platforms.',
                'logo' => asset('/img/logo/50x50/soundcloud_50x50.png'),
                'slug' => 'soundcloud',
                'link_1' => 'https://soundcloud.com',
                'platforms' => 'windows,mac,ios,android,linux,ubuntu,web',
                'image_1' => "https://miro.medium.com/max/3200/0*K7oSKLT-ZNnDZ1bx",
                'video_1' => "",
                'publisher_slug' => 'soundcloud',
                'entity_type' => 'software',
                "tags" => ["music streaming", "music uploading", "music player", "music sharing"]

            ],
            /*TIDAL*/
            [
                'title' => 'TIDAL',
                'short_description' => 'Tidal is a high-quality audio streaming platform, similar to Spotify.',
                'description' => 'TIDAL is a service from Norway that is used for music or video streaming and offers you limitless videos and music. TIDAL was founded by a Norwegian public entity named Aspiro in 2014 and currently, the service is owned by an American payment processing organization named Block, Inc.  After they signed distributions agreements with the major 3 major record labels and several self-managing labels, TIDAL service attests that they offer access to over 70 million songs and even about 250,000 videos. Essentially, the application offers its services in a two-level system: Tidal HiFi Plus and Tidal HiFi. The service also attests that they offer the greatest percentage of royalties to artists who sing and write songs in the streaming market of music.  However, in 2015, Project Panther Bidco company purchased Aspiro and relaunched the product by using a very big marketing campaign and it was the first and growing service for streaming music belonging to an artist.',
                'logo' => asset('/img/logo/50x50/tidal_50x50.png'),
                'slug' => 'tidal',
                'link_1' => 'https://tidal.com',
                'platforms' => 'windows,mac,ios,android',
                'image_1' => "https://audioxpress.com/assets/upload/images/1/20200331202328_Tidal-StreamingGenericWeb.jpg",
                'video_1' => "",
                'publisher_slug' => 'tidal',
                'entity_type' => 'software',
                "tags" => ["music streaming", "music player"]


            ],
            /*Deezer*/
            [
                'title' => 'Deezer',
                'description' => 'As a music lover, you can listen to your favorite music at any place at any time using Deezer. You can do it on your Android, Mac, Windows devices, and many more.   It is free to download for all users and allows you to enjoy a whole catalog of up to 73 million tracks. You can discover any latest music releases and try coming up with your library.   Moreover, it has made it more convenient to listen to any music online, come up with a playlist, and share with your loved ones without incurring any extra costs.   Additionally, it allows you to download your favorite music for you to listen to them offline using different plans such as Deezer family, Deezer premium, and many more.   All you need to do is to download it on your device then signup for free. When you are done logging in, you can go ahead and stream any music of your choice.',
                'logo' => asset('/img/logo/50x50/deezer_50x50.png'),
                'slug' => 'deezer',
                'link_1' => 'https://deezer.com',
                'platforms' => 'windows,mac,ios,android,web',
                'image_1' => "https://www.trustedreviews.com/wp-content/uploads/sites/54/2018/08/Screenshot-2020-05-14-at-00.29.31.png",
                'video_1' => "",
                'publisher_slug' => 'deezer',
                'entity_type' => 'software',
                "tags" => ["music streaming", "music player"]


            ],
            /*YouTube Music*/
            [
                'title' => 'YouTube Music',
                'description' => 'YouTube Music is a new audio service that gives users greater access to sound. Sound quality is put at a premium, which is good news for the user base. The user base is actually growing at a rapid pace these days. The people want to see how the music will be played. It is simple to start a new user account through YouTube Music as well. The new users will then gain access to incredible tools and new musical artists too.  The best idea is to read all of the new reviews. The critics have backed YouTube Music since it was created. The user base is glad to see the project move ahead in a short time span. YouTube Music is happy to be a leader in many new ways. The updates will show users what new features are being added. Remember to write a new review for YouTube Music.',
                'logo' => asset('/img/logo/50x50/youtube-music_50x50.png'),
                'slug' => 'youtubemusic',
                'link_1' => 'https://music.youtube.com',
                'platforms' => 'windows,mac,ios,android,web',
                'image_1' => "https://i0.wp.com/9to5google.com/wp-content/uploads/sites/4/2020/12/youtube-music-2020-year-in-review.png?w=1024&quality=82&strip=all&ssl=1",
                'video_1' => "",
                'publisher_slug' => 'Google',
                'entity_type' => 'software',
                "tags" => ["music streaming", "music player"]
            ],
            /*Saavn*/
            [
                'title' => 'Saavn',
                'description' => 'Saavn, now known as JioSaavn, is the most popular music streaming platform in India and Indian communities around the world.  Since, it was established in 2007, Saavn has acquired rights to 60 million music tracks in 15 languages and dialects such as English, Bengali, Tamil and Malayalam.  Saavn is a free music streaming service with advertisements. If customers want improved streaming quality and music downloads for offline listening, they have to register for paid subscriptions.  In March 2018, Saavn entered into a merger with JioMusic valued at $1 billion. It was then rebranded as JioSaavn.  Saavn was created in 2007 by Rishi Malhotra, Vinodh Bhat and Paramdeep Singh, who are all still connected to the company today as the CEO, President and Executive Vice Chairman respectively.  To get started on Saavn, you simply just have to download its app (JioSaavn) from the Google Play Store or the iOS App Store.',
                'logo' => asset('/img/logo/saavn.png'),
                'slug' => 'saavn',
                'link_1' => 'https://www.jiosaavn.com/',
                'image_1' => "https://stemjar.b-cdn.net/wp-content/uploads/2017/12/saavn-review-696x393.jpg",
                'video_1' => "",
                'publisher_slug' => 'jiosaavn',
                'entity_type' => 'software',
                "tags" => ["music streaming", "music player"],
                'platforms' => 'windows,mac,ios,android,web',

            ]
        ], 'music');
        $this->entitySeederLoop([
            [
                'slug' => 'fl-studio',
                'title' => 'FL Studio',
                'description' => "FL Studio is one of the best software for music production that we can find today, as it contains all the tools and is more economical than other software of lower quality. It has an easy-to-use interface and is easy to configure to your liking. In addition, you can control the patterns with the virtual mixer to create music with effects. Also, it has an editor included with which you can improve the audio quality, among other things.

Another feature that makes FL Studio stand out is the large library of inbuilt samples and plugins you have at your disposal, which you can use to create original music, the combinations and effects you can achieve are endless. This software is so easy to use that it is recommended for amateurs who just want to have fun mixing, but at the same time, it has the quality to be used by professionals. The only downside is that if you don't have a computer with a graphic card, it may not work in optimal conditions since it will force the CPU to the maximum. ",
                'logo' => asset('img/logo/fl-studio.png'),
                'link_1' => 'https://www.image-line.com/',
                'platforms' => 'windows,mac,android,ios',
                'image_1' => asset('img/featured/fl-studio.png'),
                'video_1' => "",
                'publisher_slug' => 'image-line',
                'entity_type' => 'software',
                'tags' => ['DAW', 'Music Production']
            ],
            [
                'slug' => 'ableton-live',
                'title' => 'Ableton Live',
                'description' => "When it comes to making music, having a different frame of mind is absolutely necessary when using Ableton Live. It is easy for me to understand why Live has such a large number of followers. This piece of software has garnered a lot of praise over the years from users who credit it as an essential part of their songwriting process, particularly when it comes to live performances of their music. It has a clip-based live performance and composition workflow that is both inspiring and motivating, as well as excellent new Mood Reel and Drone Lab packs, and it is incredibly easy to navigate. But do consider that it doesn't have a notation view or a pitch correction tool, and despite its high price, it's not a DAW that can do everything. Having said all that, in its most recent iteration, Ableton Live is indeed still a powerful all-in-the-box solution that can be used for composing and performing live music, especially live music influenced by electronic tunes. ",
                'logo' => asset('img/logo/ableton-live.png'),
                'link_1' => 'https://www.ableton.com/en/',
                'platforms' => 'windows,mac',
                'image_1' => asset('img/featured/ableton-live.png'),
                'video_1' => "",
                'publisher_slug' => 'ableton',
                'entity_type' => 'software',
                'tags' => ['DAW', 'Music Production']
            ],
            [
                'slug' => 'pro-tools',
                'title' => 'Avid Pro Tools',
                'description' => "The workflow effectiveness of Avid's Pro Tools software is unmatched among computer-based digital recording choices today. Since its beginning, the company has worked tirelessly to fine-tune the program. Each improvement has been based only on practical considerations. As a result of Avid's efforts, the production process has become far easier than before. To make things simpler, Pro-tools has a two-window user interface. Everything can be accessed from the primary window, and editing can be done in-line without the need for other windows to pop up all over the place. The old plug-in formats from Avid have been replaced with a new AAX plug-in architecture that can compensate for latency. For epic memory management, it has a 64-bit audio engine. Even if a project is extremely large, it always performs at its best. Free up resources by using the track commit and track freeze commands to select what's important. When it initially hit the market, the Pro Tools recording software suite revolutionized the industry. It's long since changed into something else entirely. Pro Tools is the most popular digital audio workstation (DAW) on the market today, even in the face of stiff competition. A total of 128 audio tracks, 500+ instrument tracks, and over 1000 MIDI tracks are available for recording. A variety of tools are at your disposal, including layered editing, real-time fade adjustment, and batch fade optimization. ",
                'logo' => asset('img/logo/pro-tools.png'),
                'link_1' => 'https://www.avid.com/pro-tools',
                'platforms' => 'windows,mac',
                'publisher_slug' => 'avid',
                'entity_type' => 'software',
                'tags' => ['DAW', 'Music Production']
            ],
            [
                'slug' => 'logic-pro',
                'title' => 'Logic Pro X',
                'description' => "Apple's Logic Pro X music creation software has been one of the company's hidden gems for a long period of time. Although more people will use iPhones, iPads, and Macs, Logic still has a leg up in terms of quality, value, and the release of new features on a regular basis. Logic Pro X is the greatest it's ever been, with to the addition of Apple Silicon compatibility including several entertaining and the forward new features. Logic Pro's popularity continues to rise. Users of AirPods or AirPods Max will be happy to know that version 10.7, like previous versions 10.6 and 10.5 before it, allows them to create Spatial Audio mixes. When you factor in the addition of current features like Live Loops and improved support for the Apple environment, Logic Pro is now as much a piece of software for having fun with music as it is a fully-featured recording studio. Aside from that, running Logic on an Apple laptop with Silicon support means you'll get maximum performance and power efficiency, which means you can be creative wherever you are without worrying about your laptop dying because it's running out of juice. ",
                'logo' => asset('img/logo/logic-pro.jpg'),
                'link_1' => 'https://www.apple.com/uk/logic-pro/',
                'platforms' => 'mac,ios',
                'publisher_slug' => 'apple',
                'entity_type' => 'software',
                'tags' => ['DAW', 'Music Production']
            ],
        ], 'music-production');
    }

    private
    function seedOfficeProductivity(): void
    {
        $this->entitySeederLoop([
            [
                'title' => 'LibreOffice',
                'slug' => 'libreoffice',
                'description' => 'LibreOffice is a free and open-source application that you can use to perform tasks like word processing, spreadsheet calculations, and presentation. The original author was Star Division and it was developed by The Document Foundation in January 2011. Its stable release was 11 years later in 2022. It can be used in most operating systems and is written in C++, XML, and Java. It is available in 119 languages.  A lot of people use this application due to its user-friendly functions and features. They have improved compatibility in exporting .docx format documents. Its safety feature is top-notch with the use of OpenPGP keys to sign in. You can create E-book with an Epub export function, use a pivot chart for complex spreadsheets, usage of watermarks to customize your sheet, and an attractive presentation template to make your work even better. Calc has a major spreadsheet performance boost which makes it easier to use. They also included guide books for your convenience in case of any issue and can use safe mode if you suspect have any issue with the setup. The main part of LibreOffice is writer, calc, impress, draw, base, math, charts, and extensions.  You do not have to pay for the license fee and can be used for an individual, a home office, or even a big enterprise with thousands of workers. This will be a great alternative to any other major office application.',
                'logo' => asset('img/logo/libreoffice.png'),
                'link_1' => '',
                'platforms' => 'windows,mac,linux',
                'publisher_slug' => '',
                'entity_type' => 'software',
                "tags" => ["Office", "Word Processor", "Spreadsheet"]
            ],
            [
                'title' => 'Zapier',
                'slug' => 'zapier',
                'description' => 'Started in 2012, Zapier was founded by Bryan Helmig, Wade Foster, and Mike Knoop. It is a web-based automation tool that allows users to connect various apps together. What started as a tool for developers has now become one of the most popular automation tools in the world, with over a million users.  Zapier is unique because it allows users to connect various apps together. This means that you can automate tasks between different apps - such as saving a file to Dropbox every time you create a new document in Google Drive or sending an email notification every time a new ticket is created in Salesforce (or supported CRM of your choice). These automation commands also called zaps, can save users a lot of time and hassle.  Zapier has over 3,000 integrations with various apps and can be used for free or with a subscription plan. It\'s popular among businesses as it allows them to automate tasks, create workflows, and save an enormous amount of time.',
                'logo' => asset('img/logo/zapier.png'),
                'link_1' => '//zapier.com',
                'platforms' => 'web',
                'publisher_slug' => '',
                'entity_type' => 'software',
                "tags" => ["Workflow Automation", "Task Automation"]
            ],
            [
                'title' => 'IFTTT',
                'slug' => 'ifttt',
                'description' => 'IFTTT is a web-based service that allows users to create chains of conditional statements, called applets. These applets are used to automate tasks across different web services and devices. Founded by Jesse Tane and Tibbets in San Francisco, California in 2010, the said service has been powering more than 630 services offered by the big names in the industry such as Dropbox, Amazon Alexa, Twitter, Spotify, Slack, and Fitbit among many others.  IFTTT boasts of its simple, easy-to-use interface. Users can create applets by selecting the services they want to connect and then creating a trigger and an action. IFTTT has been used for a variety of purposes, from automating social media posts to turning off lights when no one is home.  IFTTT is free to use, with paid upgrades available for businesses. It has been proven to be a valuable tool for both personal and professional use, with its current audience focused on business owners and entrepreneurs.',
                'logo' => asset('img/logo/ifttt.png'),
                'link_1' => '//ifttt.com',
                'platforms' => 'web,android,ios',
                'publisher_slug' => '',
                'entity_type' => 'software',
                "tags" => ["Workflow Automation", "Task Automation"]
            ],
            [
                'title' => 'Microsoft Publisher',
                'slug' => 'microsoft-publisher',
                'description' => 'Microsoft Publisher is a software made for desktop publishing developed by Microsoft although it is similar to the famous Microsoft Word it differs in certain page layouts and design. It is best used for writing and publishing academic, and business papers due to its design and interface that is easy to use for writing compositions, it is also best for publishing materials because it can be outlined with the appropriate citations and format. Most of the users of this software application are academic writers who published books and research papers such as thesis and dissertations who are in need of constant revisions on their contents and even in the format. It is an all-around publishing application that has been very helpful in creating wonderful and informative content that is being read by different people around the world. Overall this is a very useful application that still needs to be in MS office packages.',
                'logo' => asset('img/logo/microsoft-office-publisher.png'),
                'link_1' => 'https://www.microsoft.com/en-gb/microsoft-365/publisher',
                'platforms' => 'web,windows,mac,linux',
                'publisher_slug' => '',
                'entity_type' => 'software',
                "tags" => ["Word Processor", "Export to PDF", "Desktop Publisher"]
            ],
        ], "office-productivity");
        $this->entitySeederLoop([
            [
                'title' => 'Gmail',
                'slug' => 'gmail',
                'description' => 'Gmail was created in 2004 by Paul Buchheit, a Google developer, and was one of the first web-based email clients. It is now the most popular email client in the world with over a billion users. Released with the intention of replacing email clients such as Outlook and Hotmail, Gmail offered several features that were not available at the time.  What made Gmail unique was its storage capacity (at first it offered one gigabyte of storage) and its search function. It also had a threaded conversation view, which grouped all messages from a conversation together. This feature is now common in most email clients.  Gmail is available as a web-based client and as an app for smartphones and tablets. It\'s free to use with a Google account and comes with a variety of features, such as the ability to create labels and filters, add signatures, and set up vacation responders. Gmail is popular among individuals and businesses for its reliability, ease of use, and other features.',
                'logo' => asset('img/logo/gmail.png'),
                'link_1' => '//gmail.com',
                'platforms' => 'windows,mac,linux,web,android,ios',
                'publisher_slug' => 'google',
                'entity_type' => 'software',
                "tags" => ["email, email client"]
            ],
            [
                'title' => 'Zoho Mail',
                'slug' => 'zoho-mail',
                'description' => 'Zoho Mail is a web-based email service offered by Zoho Corporation, a subsidiary of Intuit. It was founded in 2005 and offers users the ability to create an email account with their own domain name.  Zoho Mail is popular among businesses because it offers a wide range of features, including the ability to create custom email addresses, send and receive large files, and track the delivery status of emails. It also has a wide range of integrations with other Zoho applications, such as CRM, Projects, and Invoice.  What makes Zoho Mail unique is that it offers a wide range of features at no cost. It is perfect for businesses who are looking for a reliable and feature-rich email service. It offers a variety of subscription plans, with the first one being free.  Paid subscription offers additional features, such as increased storage, priority support, and more. Available in iOS, Android, and Windows.',
                'logo' => asset('img/logo/zoho-mail.png'),
                'link_1' => 'https://www.zoho.com/mail/',
                'platforms' => 'windows,mac,linux,web,android,ios',
                'publisher_slug' => 'google',
                'entity_type' => 'software',
                "tags" => ["email, email client"]
            ],
            [
                'title' => 'Apple Mail',
                'slug' => 'apple-mail',
                'description' => 'Apple Mail is a free, built-in email application that comes with macOS and iOS devices. It was first released in 2001 as part of the Mac OS X operating system and has been included in all subsequent releases of macOS. Since then, it has become an integral part of the Apple ecosystem and has been pre-installed on all iOS devices.  Its integration with macOS and other Apple applications, such as Calendar and Contacts, makes it a popular choice for businesses. It also has a wide range of features, including the ability to create custom email addresses, send and receive large files, and track the delivery status of emails.  Apple Mail is also perfect for individuals who are looking for an email application that integrates well with other Apple applications. It offers a wide range of features and is free to use. This application also allows users to add other e-mail accounts, such as Gmail and Yahoo, making access to all inboxes easy and convenient.',
                'logo' => asset('img/logo/apple-mail.png'),
                'link_1' => 'https://apps.apple.com/us/app/mail/id1108187098',
                'platforms' => 'mac,ios',
                'publisher_slug' => 'apple',
                'entity_type' => 'software',
                "tags" => ["email, email client"]
            ],
            [
                'title' => 'Opera Mail',
                'slug' => 'opera-mail',
                'description' => 'Opera Mail is a free, open-source email client for Windows, Mac, and Linux operating systems. Opera Mail was designed with the user in mind, featuring an easy-to-use interface and plenty of features to keep users organized and productive.  Some of these features include a powerful search engine that can quickly find messages, contacts, and attachments, threaded conversations to keep track of email exchanges, customizable shortcuts for common tasks, and support for both IMAP and POP email accounts.  Opera Mail is created by Opera Software, a Norwegian software company known for its web browsers, and has been included in the Opera browser suite since 2003. It\'s available as a standalone application or as part of the Opera browser suite.  It is free, open-source, and easy to use. It\'s a good choice for anyone who wants an easy-to-use email client with a lot of features. It\'s ideal for managing multiple email accounts and offers tabbed browsing to make multitasking easier.',
                'logo' => asset('img/logo/opera-mail.png'),
                'link_1' => 'https://www.getmailbird.com/opera-mail/',
                'platforms' => 'windows,mac,linux,web,android,ios',
                'publisher_slug' => 'opera',
                'entity_type' => 'software',
                "tags" => ["email, email client"]
            ],
            [
                'title' => 'Thunderbird',
                'slug' => 'thunderbird',
                'description' => 'Thunderbird is a free, open-source email client that\'s been around for over a decade. It\'s available on Windows, Mac, and Linux, and it has a ton of features that make it an excellent choice for anyone looking for an alternative to Outlook or Apple Mail.  Some of Thunderbird\'s best features include a powerful search tool that makes it easy to find emails, contacts, and attachments, and the ability to manage multiple email accounts in one place.  Additionally, it is also known for its built-in calendar allowing Google or iCloud integration, as well as its support for add-ons that can add extra features like spell check or a to-do list.  Created by Mozilla in 2002, Thunderbird is one of the most popular email clients in the world and has a large user base of over 450 million people. It is a popular choice for individuals and businesses looking for an email client that\'s both powerful and easy to use.  Unfortunately, Thunderbird isn\'t available on mobile devices, but Mozilla is working on a new project called Thunderbird Lite that will bring the features of Thunderbird to Android and iOS.',
                'logo' => asset('img/logo/thunderbird.png'),
                'link_1' => 'https://www.thunderbird.net/',
                'platforms' => 'windows,mac,linux',
                'publisher_slug' => 'mozilla',
                'entity_type' => 'software',
                "tags" => ["email, email client"]
            ],
            [
                'title' => 'Airmail',
                'slug' => 'airmail',
                'description' => 'Airmail is a powerful email client tool designed by an Italian software company named Bloop SRL for the iPhone and Mac OS, its user interfaced and overall design is customizable for the needs of the clients. The entire interface of the software is easy to navigate and understand making user friendly for first-time Apple users. Most of the users of this Apple software are businessmen since most of its features are for business-related connections, it is a paid software that has a monthly subscription fee and the features of the software are assured by Apple that it will be well-protected since they always prioritize the privacy of their customers which means that the email being sent by Airmail is absolutely encrypted and can never be bypass any software or hacker. Despite it being not free it is still one of the most popular application software in the Appstore and best of all privacy is always their priority.',
                'logo' => asset('img/logo/airmail.png'),
                'link_1' => 'https://www.airmailapp.com/',
                'platforms' => 'mac,ios',
                'publisher_slug' => 'airmail',
                'entity_type' => 'software',
                "tags" => ["email, email client"]
            ],
            [
                'title' => 'Evolution',
                'slug' => 'evolution',
                'description' => 'Gnome Evolution is the personal information manager for Gnome. Its original author is Ximian and that is why it is used to be known as Ximian evolution. It was developed by The Gnome Project and its initial release was on 10th May 2000 with the stable release coming on 3rd December 2021. It is written in C (GTK) for Unix-like operating systems and uses 53 languages.  This platform makes your organization, storage, and retrieval easy. It can work with one or several computers that are connected through a network to organize email, calendar, calendar, and task lists. Its email is encrypted with GPG and S/MIME and you can retrieve it using POP and IMAP protocols. Your network connection is safe because it is encrypted with SSL, TLS, and email filters. It has connectivity with multiple servers, supports calendar, address book, contact management, news client, and RSS reader plug-in. It has automated spam filtering that you can use to avoid malware and spam messages. You can also import files from Microsoft Outlook and synchronize them with SynEvolution. In short, you can manage your work and organize it with all these features from one place with ease.  Anyone can use this platform to organize their network but you should have a Gnome network to use evolution. Usually, big organizations and businesses use it to get organized.',
                'logo' => asset('img/logo/evolution.png'),
                'link_1' => 'https://wiki.gnome.org/Apps/Evolution',
                'platforms' => 'linux',
                'publisher_slug' => 'gnome',
                'entity_type' => 'software',
                "tags" => ["email, email client", 'calendar', 'address book']
            ],
            [
                'title' => 'eM Client',
                'slug' => 'em-client',
                'description' => 'eM Client is a tool that is used to boost your email transaction and skyrocket your productivity It was developed by eM Client Inc and its initial release was on 27th November 2007. Its stable release was on 22nd March 2021 and it is written in C++. eM Client is used in Microsoft Windows and macOS operating systems and is available in 20 languages.  eM Client not only has email support but also boosts productivity overall by supporting other tools like notes, chat, contacts, calendar, and tasks. It can be connected to any other emails service like Google Workspace, Office 365, outlook, and exchange. The email service is not only automated, but it also has a service to import email with ease. Its unique sidebar makes accessing your information very easy. eM Client is also customizable and the background or theme can be altered as you like. Other than that, it can be used on your touch screen devices, has an automatic backup tool, comes with super-fast search, Instant translation for all messages, customizable signature and template, and watch for replies and snooze function.  It has a free version with limited access or a Pro version with full access. It can be used by anyone that needs to be organized and need to boost productivity, no matter individual or organization.',
                'logo' => asset('img/logo/em-client.png'),
                'link_1' => 'https://emclient.com/',
                'platforms' => 'windows,mac',
                'publisher_slug' => 'em-client',
                'entity_type' => 'software',
                "tags" => ["email, email client", 'calendar', 'address book']
            ],
            [
                'title' => 'Proton Mail',
                'slug' => 'proton-mail',
                'description' => 'Proton email is a kind of email service that is end to end and very encrypted. It was founded in 2013 in Geneva Switzerland and was developed by the CERN Research facility, they pride themselves in ensuring their client\'s privacy due to the Swiss privacy laws because the servers are in Switzerland. The entire user interface is very easy to understand and to use with its modern design perfect for business owners and corporate emails that are in need to be confidential. Some of the users of these are business people, government agents, and paranoid people who want to keep everything private, perhaps the best thing that this email software has to offer is the level of privacy and encryption giving their clients peace of mind when it comes to privacy even the documents being attached to the email will also be encrypted and best of all the entire software is free of charge.',
                'logo' => asset('img/logo/protonmail.png'),
                'link_1' => 'https://protonmail.com/',
                'platforms' => 'web',
                'publisher_slug' => 'protonmail',
                'entity_type' => 'software',
                "tags" => ["email, email client", 'calendar', 'address book']
            ],
            [
                'title' => 'Mailbird',
                'slug' => 'mailbird',
                'description' => 'Mailbird is a desktop managing software that focuses on organizing and managing emails from different email platforms such as Outlook, Gmail, and yahoo mail making it an all-in-one email organizer from different email platforms that are currently being used on the internet today. Despite these, it is very secure and encrypted ensuring the privacy of their users when using their email management software. Most of the users are usually people who have different email accounts across different platforms making it very difficult to organized especially during busy times. Despite being used across different platforms it is very to use because of its user-friendly interface and best of all it is free to download. It can be downloaded and used in different operating systems of windows making it completely reliable for clients who are not up to date when it comes to the latest windows pc, best thing about it is that it does not take a lot of storage space during installation.',
                'logo' => asset('img/logo/mailbird.png'),
                'link_1' => 'https://mailbird.com/',
                'platforms' => 'web',
                'publisher_slug' => 'mailbird',
                'entity_type' => 'software',
                "tags" => ["email, email client", 'calendar', 'address book']
            ],
        ], 'email-client');
        $this->entitySeederLoop(
            [
                [
                    'title' => 'Google Sheets',
                    'slug' => 'google-sheets',
                    'description' => 'Google sheets are considered to be a spreadsheet program as part of google\'s free web-based google document editor that is being offered by the tech giant Google. It is available on the web application, desktop application for windows, and mobile application for android users.   Google Sheets is similar to Microsoft\'s Excel making it completely compatible for users. It is mostly used for data entry and data organizations, people who use google sheets are usually accountants, statisticians, and mathematicians since organizing numbers is more efficient in google sheets because of the ready-to-use tables inside the software.   Using google sheets is much easier than any other software since it can be saved automatically because it can be synced with the user\'s Google account which makes it safe and secured for doing delicate data projects. Most of all it is free to used the user does not have to pay any subscription fee which makes using very worthwhile.',
                    'logo' => asset('img/logo/google-drive---sheets.png'),
                    'link_1' => 'https://www.microsoft.com/en-us/microsoft-365/excel',
                    'platforms' => 'windows,mac,linux,web,android,ios',
                    'publisher_slug' => '',
                    'entity_type' => 'software',
                    "tags" => ["Spreadsheet"]
                ],
                [
                    'title' => 'Airtable',
                    'slug' => 'airtable',
                    'description' => 'Airtable is a collaborative software that was founded in 2012 by Howie Liu, Andrew Ofstad, and Emmett Nicholas.  This online platform is pretty easy to use and it allows you to create and share databases. This software has 5 different features that are used for different purposes. The bases, which you can start form zero and use any of the templates that you can find in the software. The tables, used for compiling a list of data about a particular subject, each base can have one or more table. The fields, these are the equivalent of a column in a spreadsheet, and are designed to coherence to the data. The records, which are the equivalent to a row in a spreadsheet. And at least the views, which allow you to create customized views of the data, perfect to see specific things of the database.  Airtable is a very complete and comfortable to use software, and a very good tool for database management. It can be used for many different purposes even for business or just for digitalizing your daily processes and manage your time.',
                    'logo' => asset('img/logo/airtable.png'),
                    'link_1' => 'https://airtable.com',
                    'platforms' => 'windows,mac,linux',
                    'publisher_slug' => 'airtable',
                    'entity_type' => 'software',
                    "tags" => ["Spreadsheet"]
                ],
                [
                    'title' => 'Microsoft Excel Online',
                    'slug' => 'microsoft-excel-online',
                    'description' => 'Microsoft Office Excel Online is an online data spreadsheet that can be used by different users in an online sharing method or more likely real-time co-authoring capabilities enabling collaboration between colleagues. It was developed by Microsoft as a way of doing data spreadsheets on an online platform.   Since Microsoft Office Excel is about data entry which it must be done through scan and most of its users are accountants, statisticians, and financial experts, because of it being in an online platform editing can be very easy and efficient especially if there has been a technical error in the data entry making it very easy for a colleague to correct the error since he/she is in the online platform and an authorized person to view and edit the spreadsheet.   Overall this new Microsoft Office Excel Online is perfect for accounting firms because they usually deal in data entries making it an exceptional tool for data entry specialists.',
                    'logo' => asset('img/logo/microsoft-office-excel.png'),
                    'link_1' => 'https://office.live.com/start/excel.aspx',
                    'platforms' => 'windows,mac,linux,web,android,ios',
                    'publisher_slug' => 'microsoft',
                    'entity_type' => 'software',
                    "tags" => ["Spreadsheet"]
                ],
                [
                    'title' => 'SmartSheet',
                    'slug' => 'smartsheet',
                    'description' => 'Smartsheet is a "software as a service" or in short SaaS that offers work management and collaboration. Using a tabular user interface it will assign tasks, manage calendars and track project progress. It was developed by Smartsheet Inc and was first released in 2006. It can be used in web platforms, Android, and iOS. The application is available in English, Spanish, French, Portuguese, Japanese, German, Italian, and Russian.  This application has content management, process management, and project resource management that can manage your work in more easier and accessible ways. You have the support of the team seamlessly in a 360-degree environment. You can have access to Brandfolder which will manage your digital assets. You can use automation to do many tasks there to minimize the workload. It also comes with powerful integration and adds-on to assist you. Using a solution center, you can do any task related to IT.  Anyone can get started as a free user but once the 30 day trial period is finished, you will need to be a paying customer, and it\'s about $7 a month on a yearly subscription. Usually used by mid-sized companies and information technology-related industries.',
                    'logo' => asset('img/logo/smartsheet.png'),
                    'link_1' => 'https://www.smartsheet.com/',
                    'platforms' => 'windows,mac,linux,web,android,ios',
                    'publisher_slug' => 'smartsheet',
                    'entity_type' => 'software',
                    "tags" => ["Spreadsheet"]
                ],
                [
                    'title' => 'WPS Spreadsheets',
                    'slug' => 'wps-spreadsheets',
                    'description' => 'WPS Spreadsheets is an office suite made for Windows, Mac, Linux, IOS, and Android. It was developed by Kingsoft, the spreadsheet is one of the three components as the WPS Writer, WPS Presentation, and WPS Spreadsheet. Some of its features are very similar to Microsoft Excel but it is on the lighter side such as its interface making it more suitable for smartphone users since not everyone can bring his/her laptop anytime which makes it a great substitute. Most of its users are people who use their smartphones more frequently such as data encoders that are in the field instead of in the office and are on the go best of all the software is free and can easily be downloaded via Playstore and Appstore. Overall the software is a great substitute when to Microsoft Office especially if the user only has his/her smartphone on her hand and best of all the software is free and has no hidden charges.',
                    'logo' => asset('img/logo/wps-spreadsheets.png'),
                    'link_1' => 'https://www.wps.com/office/spreadsheet',
                    'platforms' => 'windows,mac,linux,web,android,ios',
                    'publisher_slug' => 'smartsheet',
                    'entity_type' => 'software',
                    "tags" => ["Spreadsheet"]
                ],
                [
                    'title' => 'Apache OpenOffice Calc',
                    'slug' => 'apache-openoffice-calc',
                    'description' => 'Apache OpenOffice Calc is a spreadsheet application that is used for professional data miners and data entry. It was developed by Apache Software Foundation.   It is more likely like a Spreadsheet capable of data entry and is mostly being used by accountants, statisticians, and mathematicians. Its key features include organizing data entry and data presentations that can be used for corporate meetings making it very useful for projects that are being done in a hurry.   Most of all it is free and easy to use perfect for newbies who are just starting with data entry workloads, One of its key features includes being able to be fully compatible with Microsoft Excel without damaging any contents of the file and being able to send it with another user, even with older versions of Microsoft Excel.   Overall the Apache Openoffice Calc is a great alternative for users who are on the go and having trouble learning the Microsoft Excel.',
                    'logo' => asset('img/logo/apache-openoffice-calc.png'),
                    'link_1' => 'https://www.openoffice.org/product/calc.html',
                    'platforms' => 'windows,mac,linux',
                    'publisher_slug' => 'smartsheet',
                    'entity_type' => 'software',
                    "tags" => ["Spreadsheet"]
                ],
                [
                    'title' => 'Zoho Sheet',
                    'slug' => 'zoho-sheet',
                    'description' => 'Zoho Sheet is an online spreadsheet application used for data entry and statistical jobs and it was developed by Zoho Corporation. The entire application is very similar to a Microsoft Excel and WPS spreadsheet making it very useful for accountants, statisticians, and mathematicians that deal with numbers all day. Its key feature is its online feature suitable for colleagues that have similar projects that need in-depth scanning and checking making it easier for editing and correcting any technical errors. It is very secure and the Zoho sheets are very safe to use for corporations that handle sensitive financial data. The entire user interface is much easier to understand and used since some of its users can be beginners and are starting with the data entry. Overall the Zoho Sheet is very reliable secured and safe making it more appropriate for newbies and most of all it can be downloaded for free on their website.',
                    'logo' => asset('img/logo/zoho-books.png'),
                    'link_1' => 'https://www.zoho.com/sheet/',
                    'platforms' => 'web',
                    'publisher_slug' => 'smartsheet',
                    'entity_type' => 'software',
                    "tags" => ["Spreadsheet"]
                ]
            ]
            , "spreadsheet");
    }

    private
    function seedOperatingSystem(): void
    {
        $this->entitySeederLoop([
            [
                'title' => 'Windows 11',
                'slug' => 'windows-11',
                'description' => "Windows 11 is Microsoft's flagship operating system. The most popular operating system in the world for commercial users.",
                'logo' => asset('img/logo/windows-10.png'),
                "image_1" => "https://blogs.windows.com/wp-content/uploads/prod/sites/2/2021/06/WIN_Start_GenZ_Light_16x10_en-US-1024x640.png",
                'link_1' => '',
                'platforms' => 'windows',
                'publisher_slug' => 'microsoft',
                'entity_type' => 'software',
                "tags" => ["Windows OS", "Operating System", "OS"]
            ],
            [
                'title' => 'Ubuntu',
                'slug' => 'ubuntu',
                'description' => "Ubuntu is the modern, open source operating system on Linux for the enterprise server, desktop, cloud, and IoT.",
                'logo' => asset('img/logo/ubuntu.png'),
                "image_1" => "https://upload.wikimedia.org/wikipedia/commons/a/ac/Ubuntu_22.04_LTS_Jammy_Jellyfish.png",
                'link_1' => 'https://ubuntu.com/download',
                'platforms' => 'linux',
                'publisher_slug' => '',
                'entity_type' => 'software',
                "tags" => ["Operating System", "OS", "Linux OS"]
            ],
            [
                'title' => 'Debian',
                'slug' => 'debian',
                'description' => "Debian is a hugely popular open-source operating system. Based on Linux.",
                'logo' => asset('img/logo/debian.png'),
                "image_1" => "https://upload.wikimedia.org/wikipedia/commons/d/d0/Debian_11_with_GNOME_desktop.png",
                'link_1' => '',
                'platforms' => 'linux',
                'publisher_slug' => '',
                'entity_type' => 'software',
                "tags" => ["Operating System", "OS", "Linux OS"]
            ],
            [
                'title' => 'Linux Mint',
                'slug' => 'linux-mint',
                'description' => "Linux Mint is a hugely popular open-source operating system. Based on Linux.",
                'logo' => asset('img/logo/linux-mint.png'),
                "image_1" => "https://upload.wikimedia.org/wikipedia/commons/6/69/Linux_Mint_20.3_%28Una%29_Cinnamon.png",
                'link_1' => '',
                'platforms' => 'linux',
                'publisher_slug' => '',
                'entity_type' => 'software',
                "tags" => ["Operating System", "OS", "Linux OS"]
            ],
        ], "operating-system");
        $this->entitySeederLoop([
            [
                'title' => 'Gmail',
                'slug' => 'gmail',
                'description' => 'Gmail was created in 2004 by Paul Buchheit, a Google developer, and was one of the first web-based email clients. It is now the most popular email client in the world with over a billion users. Released with the intention of replacing email clients such as Outlook and Hotmail, Gmail offered several features that were not available at the time.  What made Gmail unique was its storage capacity (at first it offered one gigabyte of storage) and its search function. It also had a threaded conversation view, which grouped all messages from a conversation together. This feature is now common in most email clients.  Gmail is available as a web-based client and as an app for smartphones and tablets. It\'s free to use with a Google account and comes with a variety of features, such as the ability to create labels and filters, add signatures, and set up vacation responders. Gmail is popular among individuals and businesses for its reliability, ease of use, and other features.',
                'logo' => asset('img/logo/gmail.png'),
                'link_1' => '//gmail.com',
                'platforms' => 'windows,mac,linux,web,android,ios',
                'publisher_slug' => 'google',
                'entity_type' => 'software',
                "tags" => ["email, email client"]
            ],
            [
                'title' => 'Zoho Mail',
                'slug' => 'zoho-mail',
                'description' => 'Zoho Mail is a web-based email service offered by Zoho Corporation, a subsidiary of Intuit. It was founded in 2005 and offers users the ability to create an email account with their own domain name.  Zoho Mail is popular among businesses because it offers a wide range of features, including the ability to create custom email addresses, send and receive large files, and track the delivery status of emails. It also has a wide range of integrations with other Zoho applications, such as CRM, Projects, and Invoice.  What makes Zoho Mail unique is that it offers a wide range of features at no cost. It is perfect for businesses who are looking for a reliable and feature-rich email service. It offers a variety of subscription plans, with the first one being free.  Paid subscription offers additional features, such as increased storage, priority support, and more. Available in iOS, Android, and Windows.',
                'logo' => asset('img/logo/zoho-mail.png'),
                'link_1' => 'https://www.zoho.com/mail/',
                'platforms' => 'windows,mac,linux,web,android,ios',
                'publisher_slug' => 'google',
                'entity_type' => 'software',
                "tags" => ["email, email client"]
            ],
            [
                'title' => 'Apple Mail',
                'slug' => 'apple-mail',
                'description' => 'Apple Mail is a free, built-in email application that comes with macOS and iOS devices. It was first released in 2001 as part of the Mac OS X operating system and has been included in all subsequent releases of macOS. Since then, it has become an integral part of the Apple ecosystem and has been pre-installed on all iOS devices.  Its integration with macOS and other Apple applications, such as Calendar and Contacts, makes it a popular choice for businesses. It also has a wide range of features, including the ability to create custom email addresses, send and receive large files, and track the delivery status of emails.  Apple Mail is also perfect for individuals who are looking for an email application that integrates well with other Apple applications. It offers a wide range of features and is free to use. This application also allows users to add other e-mail accounts, such as Gmail and Yahoo, making access to all inboxes easy and convenient.',
                'logo' => asset('img/logo/apple-mail.png'),
                'link_1' => 'https://apps.apple.com/us/app/mail/id1108187098',
                'platforms' => 'mac,ios',
                'publisher_slug' => 'apple',
                'entity_type' => 'software',
                "tags" => ["email, email client"]
            ],
            [
                'title' => 'Opera Mail',
                'slug' => 'opera-mail',
                'description' => 'Opera Mail is a free, open-source email client for Windows, Mac, and Linux operating systems. Opera Mail was designed with the user in mind, featuring an easy-to-use interface and plenty of features to keep users organized and productive.  Some of these features include a powerful search engine that can quickly find messages, contacts, and attachments, threaded conversations to keep track of email exchanges, customizable shortcuts for common tasks, and support for both IMAP and POP email accounts.  Opera Mail is created by Opera Software, a Norwegian software company known for its web browsers, and has been included in the Opera browser suite since 2003. It\'s available as a standalone application or as part of the Opera browser suite.  It is free, open-source, and easy to use. It\'s a good choice for anyone who wants an easy-to-use email client with a lot of features. It\'s ideal for managing multiple email accounts and offers tabbed browsing to make multitasking easier.',
                'logo' => asset('img/logo/opera-mail.png'),
                'link_1' => 'https://www.getmailbird.com/opera-mail/',
                'platforms' => 'windows,mac,linux,web,android,ios',
                'publisher_slug' => 'opera',
                'entity_type' => 'software',
                "tags" => ["email, email client"]
            ],
            [
                'title' => 'Thunderbird',
                'slug' => 'thunderbird',
                'description' => 'Thunderbird is a free, open-source email client that\'s been around for over a decade. It\'s available on Windows, Mac, and Linux, and it has a ton of features that make it an excellent choice for anyone looking for an alternative to Outlook or Apple Mail.  Some of Thunderbird\'s best features include a powerful search tool that makes it easy to find emails, contacts, and attachments, and the ability to manage multiple email accounts in one place.  Additionally, it is also known for its built-in calendar allowing Google or iCloud integration, as well as its support for add-ons that can add extra features like spell check or a to-do list.  Created by Mozilla in 2002, Thunderbird is one of the most popular email clients in the world and has a large user base of over 450 million people. It is a popular choice for individuals and businesses looking for an email client that\'s both powerful and easy to use.  Unfortunately, Thunderbird isn\'t available on mobile devices, but Mozilla is working on a new project called Thunderbird Lite that will bring the features of Thunderbird to Android and iOS.',
                'logo' => asset('img/logo/thunderbird.png'),
                'link_1' => 'https://www.thunderbird.net/',
                'platforms' => 'windows,mac,linux',
                'publisher_slug' => 'mozilla',
                'entity_type' => 'software',
                "tags" => ["email, email client"]
            ],
            [
                'title' => 'Airmail',
                'slug' => 'airmail',
                'description' => 'Airmail is a powerful email client tool designed by an Italian software company named Bloop SRL for the iPhone and Mac OS, its user interfaced and overall design is customizable for the needs of the clients. The entire interface of the software is easy to navigate and understand making user friendly for first-time Apple users. Most of the users of this Apple software are businessmen since most of its features are for business-related connections, it is a paid software that has a monthly subscription fee and the features of the software are assured by Apple that it will be well-protected since they always prioritize the privacy of their customers which means that the email being sent by Airmail is absolutely encrypted and can never be bypass any software or hacker. Despite it being not free it is still one of the most popular application software in the Appstore and best of all privacy is always their priority.',
                'logo' => asset('img/logo/airmail.png'),
                'link_1' => 'https://www.airmailapp.com/',
                'platforms' => 'mac,ios',
                'publisher_slug' => 'airmail',
                'entity_type' => 'software',
                "tags" => ["email, email client"]
            ],
            [
                'title' => 'Evolution',
                'slug' => 'evolution',
                'description' => 'Gnome Evolution is the personal information manager for Gnome. Its original author is Ximian and that is why it is used to be known as Ximian evolution. It was developed by The Gnome Project and its initial release was on 10th May 2000 with the stable release coming on 3rd December 2021. It is written in C (GTK) for Unix-like operating systems and uses 53 languages.  This platform makes your organization, storage, and retrieval easy. It can work with one or several computers that are connected through a network to organize email, calendar, calendar, and task lists. Its email is encrypted with GPG and S/MIME and you can retrieve it using POP and IMAP protocols. Your network connection is safe because it is encrypted with SSL, TLS, and email filters. It has connectivity with multiple servers, supports calendar, address book, contact management, news client, and RSS reader plug-in. It has automated spam filtering that you can use to avoid malware and spam messages. You can also import files from Microsoft Outlook and synchronize them with SynEvolution. In short, you can manage your work and organize it with all these features from one place with ease.  Anyone can use this platform to organize their network but you should have a Gnome network to use evolution. Usually, big organizations and businesses use it to get organized.',
                'logo' => asset('img/logo/evolution.png'),
                'link_1' => 'https://wiki.gnome.org/Apps/Evolution',
                'platforms' => 'linux',
                'publisher_slug' => 'gnome',
                'entity_type' => 'software',
                "tags" => ["email, email client", 'calendar', 'address book']
            ],
            [
                'title' => 'eM Client',
                'slug' => 'em-client',
                'description' => 'eM Client is a tool that is used to boost your email transaction and skyrocket your productivity It was developed by eM Client Inc and its initial release was on 27th November 2007. Its stable release was on 22nd March 2021 and it is written in C++. eM Client is used in Microsoft Windows and macOS operating systems and is available in 20 languages.  eM Client not only has email support but also boosts productivity overall by supporting other tools like notes, chat, contacts, calendar, and tasks. It can be connected to any other emails service like Google Workspace, Office 365, outlook, and exchange. The email service is not only automated, but it also has a service to import email with ease. Its unique sidebar makes accessing your information very easy. eM Client is also customizable and the background or theme can be altered as you like. Other than that, it can be used on your touch screen devices, has an automatic backup tool, comes with super-fast search, Instant translation for all messages, customizable signature and template, and watch for replies and snooze function.  It has a free version with limited access or a Pro version with full access. It can be used by anyone that needs to be organized and need to boost productivity, no matter individual or organization.',
                'logo' => asset('img/logo/em-client.png'),
                'link_1' => 'https://emclient.com/',
                'platforms' => 'windows,mac',
                'publisher_slug' => 'em-client',
                'entity_type' => 'software',
                "tags" => ["email, email client", 'calendar', 'address book']
            ],
            [
                'title' => 'Proton Mail',
                'slug' => 'proton-mail',
                'description' => 'Proton email is a kind of email service that is end to end and very encrypted. It was founded in 2013 in Geneva Switzerland and was developed by the CERN Research facility, they pride themselves in ensuring their client\'s privacy due to the Swiss privacy laws because the servers are in Switzerland. The entire user interface is very easy to understand and to use with its modern design perfect for business owners and corporate emails that are in need to be confidential. Some of the users of these are business people, government agents, and paranoid people who want to keep everything private, perhaps the best thing that this email software has to offer is the level of privacy and encryption giving their clients peace of mind when it comes to privacy even the documents being attached to the email will also be encrypted and best of all the entire software is free of charge.',
                'logo' => asset('img/logo/protonmail.png'),
                'link_1' => 'https://protonmail.com/',
                'platforms' => 'web',
                'publisher_slug' => 'protonmail',
                'entity_type' => 'software',
                "tags" => ["email, email client", 'calendar', 'address book']
            ],
            [
                'title' => 'Mailbird',
                'slug' => 'mailbird',
                'description' => 'Mailbird is a desktop managing software that focuses on organizing and managing emails from different email platforms such as Outlook, Gmail, and yahoo mail making it an all-in-one email organizer from different email platforms that are currently being used on the internet today. Despite these, it is very secure and encrypted ensuring the privacy of their users when using their email management software. Most of the users are usually people who have different email accounts across different platforms making it very difficult to organized especially during busy times. Despite being used across different platforms it is very to use because of its user-friendly interface and best of all it is free to download. It can be downloaded and used in different operating systems of windows making it completely reliable for clients who are not up to date when it comes to the latest windows pc, best thing about it is that it does not take a lot of storage space during installation.',
                'logo' => asset('img/logo/mailbird.png'),
                'link_1' => 'https://mailbird.com/',
                'platforms' => 'web',
                'publisher_slug' => 'mailbird',
                'entity_type' => 'software',
                "tags" => ["email, email client", 'calendar', 'address book']
            ],
        ], 'email-client');
        $this->entitySeederLoop(
            [
                [
                    'title' => 'Google Sheets',
                    'slug' => 'google-sheets',
                    'description' => 'Google sheets are considered to be a spreadsheet program as part of google\'s free web-based google document editor that is being offered by the tech giant Google. It is available on the web application, desktop application for windows, and mobile application for android users.   Google Sheets is similar to Microsoft\'s Excel making it completely compatible for users. It is mostly used for data entry and data organizations, people who use google sheets are usually accountants, statisticians, and mathematicians since organizing numbers is more efficient in google sheets because of the ready-to-use tables inside the software.   Using google sheets is much easier than any other software since it can be saved automatically because it can be synced with the user\'s Google account which makes it safe and secured for doing delicate data projects. Most of all it is free to used the user does not have to pay any subscription fee which makes using very worthwhile.',
                    'logo' => asset('img/logo/google-drive---sheets.png'),
                    'link_1' => 'https://www.microsoft.com/en-us/microsoft-365/excel',
                    'platforms' => 'windows,mac,linux,web,android,ios',
                    'publisher_slug' => '',
                    'entity_type' => 'software',
                    "tags" => ["Spreadsheet"]
                ],
                [
                    'title' => 'Airtable',
                    'slug' => 'airtable',
                    'description' => 'Airtable is a collaborative software that was founded in 2012 by Howie Liu, Andrew Ofstad, and Emmett Nicholas.  This online platform is pretty easy to use and it allows you to create and share databases. This software has 5 different features that are used for different purposes. The bases, which you can start form zero and use any of the templates that you can find in the software. The tables, used for compiling a list of data about a particular subject, each base can have one or more table. The fields, these are the equivalent of a column in a spreadsheet, and are designed to coherence to the data. The records, which are the equivalent to a row in a spreadsheet. And at least the views, which allow you to create customized views of the data, perfect to see specific things of the database.  Airtable is a very complete and comfortable to use software, and a very good tool for database management. It can be used for many different purposes even for business or just for digitalizing your daily processes and manage your time.',
                    'logo' => asset('img/logo/airtable.png'),
                    'link_1' => 'https://airtable.com',
                    'platforms' => 'windows,mac,linux',
                    'publisher_slug' => 'airtable',
                    'entity_type' => 'software',
                    "tags" => ["Spreadsheet"]
                ],
                [
                    'title' => 'Microsoft Excel Online',
                    'slug' => 'microsoft-excel-online',
                    'description' => 'Microsoft Office Excel Online is an online data spreadsheet that can be used by different users in an online sharing method or more likely real-time co-authoring capabilities enabling collaboration between colleagues. It was developed by Microsoft as a way of doing data spreadsheets on an online platform.   Since Microsoft Office Excel is about data entry which it must be done through scan and most of its users are accountants, statisticians, and financial experts, because of it being in an online platform editing can be very easy and efficient especially if there has been a technical error in the data entry making it very easy for a colleague to correct the error since he/she is in the online platform and an authorized person to view and edit the spreadsheet.   Overall this new Microsoft Office Excel Online is perfect for accounting firms because they usually deal in data entries making it an exceptional tool for data entry specialists.',
                    'logo' => asset('img/logo/microsoft-office-excel.png'),
                    'link_1' => 'https://office.live.com/start/excel.aspx',
                    'platforms' => 'windows,mac,linux,web,android,ios',
                    'publisher_slug' => 'microsoft',
                    'entity_type' => 'software',
                    "tags" => ["Spreadsheet"]
                ],
                [
                    'title' => 'SmartSheet',
                    'slug' => 'smartsheet',
                    'description' => 'Smartsheet is a "software as a service" or in short SaaS that offers work management and collaboration. Using a tabular user interface it will assign tasks, manage calendars and track project progress. It was developed by Smartsheet Inc and was first released in 2006. It can be used in web platforms, Android, and iOS. The application is available in English, Spanish, French, Portuguese, Japanese, German, Italian, and Russian.  This application has content management, process management, and project resource management that can manage your work in more easier and accessible ways. You have the support of the team seamlessly in a 360-degree environment. You can have access to Brandfolder which will manage your digital assets. You can use automation to do many tasks there to minimize the workload. It also comes with powerful integration and adds-on to assist you. Using a solution center, you can do any task related to IT.  Anyone can get started as a free user but once the 30 day trial period is finished, you will need to be a paying customer, and it\'s about $7 a month on a yearly subscription. Usually used by mid-sized companies and information technology-related industries.',
                    'logo' => asset('img/logo/smartsheet.png'),
                    'link_1' => 'https://www.smartsheet.com/',
                    'platforms' => 'windows,mac,linux,web,android,ios',
                    'publisher_slug' => 'smartsheet',
                    'entity_type' => 'software',
                    "tags" => ["Spreadsheet"]
                ],
                [
                    'title' => 'WPS Spreadsheets',
                    'slug' => 'wps-spreadsheets',
                    'description' => 'WPS Spreadsheets is an office suite made for Windows, Mac, Linux, IOS, and Android. It was developed by Kingsoft, the spreadsheet is one of the three components as the WPS Writer, WPS Presentation, and WPS Spreadsheet. Some of its features are very similar to Microsoft Excel but it is on the lighter side such as its interface making it more suitable for smartphone users since not everyone can bring his/her laptop anytime which makes it a great substitute. Most of its users are people who use their smartphones more frequently such as data encoders that are in the field instead of in the office and are on the go best of all the software is free and can easily be downloaded via Playstore and Appstore. Overall the software is a great substitute when to Microsoft Office especially if the user only has his/her smartphone on her hand and best of all the software is free and has no hidden charges.',
                    'logo' => asset('img/logo/wps-spreadsheets.png'),
                    'link_1' => 'https://www.wps.com/office/spreadsheet',
                    'platforms' => 'windows,mac,linux,web,android,ios',
                    'publisher_slug' => 'smartsheet',
                    'entity_type' => 'software',
                    "tags" => ["Spreadsheet"]
                ],
                [
                    'title' => 'Apache OpenOffice Calc',
                    'slug' => 'apache-openoffice-calc',
                    'description' => 'Apache OpenOffice Calc is a spreadsheet application that is used for professional data miners and data entry. It was developed by Apache Software Foundation.   It is more likely like a Spreadsheet capable of data entry and is mostly being used by accountants, statisticians, and mathematicians. Its key features include organizing data entry and data presentations that can be used for corporate meetings making it very useful for projects that are being done in a hurry.   Most of all it is free and easy to use perfect for newbies who are just starting with data entry workloads, One of its key features includes being able to be fully compatible with Microsoft Excel without damaging any contents of the file and being able to send it with another user, even with older versions of Microsoft Excel.   Overall the Apache Openoffice Calc is a great alternative for users who are on the go and having trouble learning the Microsoft Excel.',
                    'logo' => asset('img/logo/apache-openoffice-calc.png'),
                    'link_1' => 'https://www.openoffice.org/product/calc.html',
                    'platforms' => 'windows,mac,linux',
                    'publisher_slug' => 'smartsheet',
                    'entity_type' => 'software',
                    "tags" => ["Spreadsheet"]
                ],
                [
                    'title' => 'Zoho Sheet',
                    'slug' => 'zoho-sheet',
                    'description' => 'Zoho Sheet is an online spreadsheet application used for data entry and statistical jobs and it was developed by Zoho Corporation. The entire application is very similar to a Microsoft Excel and WPS spreadsheet making it very useful for accountants, statisticians, and mathematicians that deal with numbers all day. Its key feature is its online feature suitable for colleagues that have similar projects that need in-depth scanning and checking making it easier for editing and correcting any technical errors. It is very secure and the Zoho sheets are very safe to use for corporations that handle sensitive financial data. The entire user interface is much easier to understand and used since some of its users can be beginners and are starting with the data entry. Overall the Zoho Sheet is very reliable secured and safe making it more appropriate for newbies and most of all it can be downloaded for free on their website.',
                    'logo' => asset('img/logo/zoho-books.png'),
                    'link_1' => 'https://www.zoho.com/sheet/',
                    'platforms' => 'web',
                    'publisher_slug' => 'smartsheet',
                    'entity_type' => 'software',
                    "tags" => ["Spreadsheet"]
                ]
            ]
            , "spreadsheet");
    }


    private
    function seedPhotosGraphics(): void
    {

        $this->entitySeederLoop([
            [
                'slug' => 'photoshop',
                'title' => 'Adobe Photoshop',
                'short_description' => 'The leading graphics editing tool. Perfect for creating images and manipulating photos.',
                'description' => 'Adobe Photoshop is a graphics editor built for Mac OS and Windows. Originally created in 1988 by John Knoll and Thomas Knoll, the software was published on February 19, 1990, by Adobe Inc. Since then, the product has become the benchmark not only for graphics editing but also for any form of digital art. You\'ll hardly come across designers that don\'t use this cutting-edge graphics editor.  The software is capable of editing and compositing raster images in various layers. Adobe Photoshop supports alpha composting, masks, and multiple color models, including CMYK, RGB, spot color, CIELAB, and duotone. The software employs its PSB and PSD file formats in support of its features.  Adobe Photoshop has certain abilities to render or edit vector graphics and text (especially through the clipping path for vectors, videos, and 3D graphics). Users can expand the features of the software through plug-ins and supporting programs to get better results.',
                'logo' => asset('img/logo/50x50/adobe-photoshop_50x50.png'),
                'link_1' => 'https://www.adobe.com/uk/products/photoshop.html',
                'platforms' => 'windows,mac,android,ios',
                'image_1' => "https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/i/3dbbf929-b5fe-4452-bfc1-e368ee274f52/dc99o79-9f031bfa-bf9f-4f53-abe7-9cff7c0f9cdc.png",
                'video_1' => "",
                'publisher_slug' => 'adobe',
                'entity_type' => 'software',
                "tags" => ["graphic design", "photo editing"]
            ],
            [
                'slug' => 'gimp',
                'title' => 'GIMP',
                'short_description' => 'A free, open-source image editor that rivals Photoshop.',
                'description' => 'GIMP is a popular open-source and free raster graphics app that is used for manipulating images and editing images, transcoding between varied image file formats, free-form drawing, and even other advanced tasks.   This application is established under GPL-3.0 license and is compatible with Microsoft Windows, macOS, and Linux. GIMP started hosting their own downloads after ending the use of Source Forge in 2013. Later, the site repossessed this application’s idle account and used it to host the advertising format of Gimp for windows operating systems.   As per reviews, GIMP has been found to be a suitable application for those who haven’t started using photoshop and need the easiest way to edit images. Besides, it can also be fit to use in any professional space and if you like adobe photoshop, this has been pointed out as a good replacement.   For all tools for editing, you can simply get through the toolbox, via dialogue windows and menus.',
                'logo' => asset('img/logo/50x50/gimp_50x50.png'),
                'link_1' => 'https://www.gimp.org/',
                'platforms' => 'windows,mac,linux',
                'image_1' => "https://cdn0.tnwcdn.com/wp-content/blogs.dir/1/files/2019/08/gimp-Cropped-796x419.png",
                'video_1' => "",
                'publisher_slug' => 'gimp',
                'entity_type' => 'software',
                "tags" => ["graphic design", "photo editing"]
            ],
            [
                'slug' => 'paintnet',
                'title' => 'Paint.NET',
                'short_description' => 'Paint.NET is a free image and image editing software available for Windows users.',
                'description' => 'Paint.NET was created in 2004 by Rick Brewster and Gabe Mulder. It was originally created to replace the Microsoft Paint software that came with Windows. As a desktop software, Paint.NET is used for basic photo editing and touch-ups.  What makes Paint.NET unique is the ability to edit photos and add effects in a simple and easy-to-use interface. It also has a wide range of tools, including brushes, shapes, filters, overlays, adjustment, and text tools. It also comes with numerous plugins that can be installed to add more features.  It is commonly used by individuals who are not familiar with more complex photo editors, but want advanced editing features. It\'s an advanced version of Microsoft\'s Paint software and is popular among beginner and intermediate users. Over the years, it has been extensively improved to be on par with more expensive software. One of the best features that make it stand out is the warm community of users that are always willing to help.',
                'logo' => asset('img/logo/paint-net.jpg'),
                'link_1' => 'https://www.getpaint.net/',
                'platforms' => 'windows',
                'image_1' => "https://www.thurrott.com/wp-content/uploads/sites/2/2017/10/paint-net-hero.jpg",
                'video_1' => "",
                'publisher_slug' => 'dotpdn',
                'entity_type' => 'software',
                "tags" => ["graphic design", "photo editing"]
            ],
            [
                'slug' => 'krita',
                'title' => 'Krita',
                'short_description' => 'Krita is an open-source, free, graphics editor. ',
                'description' => 'Krita is an open-source and free raster graphics editor that is designed majorly for 2D animation and digital painting.   It operates on Chrome OS, Android, Linux, macOS, and Windows.   The editor is developed by Krita Foundation, KDE. The initial release of the editor was on 21 June 2005, but its stable release was on 7 January 2022. Also, the software runs C++, and Qt programming languages.   Aside from the painting features, Krita also comes with file layers, group, filter, and vector. Flatten, order, and combine layers to enable your artwork to stay organized.   Additionally, it will also help you to highlight a portion of the drawing you are doing to work on. Further, there’re extra features that enable you to insert and get rid of the selection.   If you’re an animator, comic book creator, or concept artist, this can be the best open-source software to rely on. Aside from being easy to use, it is very intuitive as well.',
                'logo' => asset('img/logo/50x50/krita_50x50.png'),
                'link_1' => 'https://krita.org/en/',
                'platforms' => 'windows,mac,linux',
                'image_1' => "https://kubadownload.com/site/assets/files/1130/krita.730x0.png",
                'video_1' => "",
                'publisher_slug' => 'krita',
                'entity_type' => 'software',
                "tags" => ["graphic design"]
            ],
            [
                'slug' => 'pixlr',
                'title' => 'Pixlr',
                'short_description' => 'Pixlr is a freemium online, web-based image editor.',
                'description' => 'Pixlr is a photo editor that was created in 2008 by Ola Sevandersson. It is one of the most popular photo editors in the world, with over 100 million users.  What makes Pixlr unique is the ability to edit photos from the mobile device - on the go. Being one of the most versatile photo editors on the market, it is considered to be a great alternative to Adobe Photoshop. It has a wide range of features, including filters, overlays, and adjustment tools. It also allows users to create memes and collages.  Pixlr is available on a variety of devices, including computers, smartphones, and tablets. It can be used for free or with a subscription plan. It has become popular for small to medium-scale businesses allowing them to edit photos without having to purchase expensive software.  Since its creation, Pixlr has become one of the most popular photo editors in the world.',
                'logo' => asset('img/logo/50x50/pixlr_50x50.png'),
                'link_1' => 'https://pixlr.com/',
                'platforms' => 'web',
                'image_1' => "https://lh3.googleusercontent.com/Ngrop-z9pcPQ6OHi7QddCmkvgusBr4RHIukEhTbMnnlcFII-nbbLn52TpJUp1e3OxKHE4Y9Mz0p3qGPB-zAOspKh=w640-h400-e365-rj-sc0x00ffffff",
                'video_1' => "",
                'publisher_slug' => '',
                'entity_type' => 'software',
                "tags" => ["graphic design", "photo editing"]
            ],
            [
                'slug' => 'affinityphoto',
                'title' => 'Affinity Photo',
                'short_description' => 'Affinity Photo is one of the best software packages for photo editing and graphic design.',
                'description' => 'Affinity Photo is a popular photo editing app for iOS devices with a simple and easy-to-use interface. It’s free, with no ads, sharing features, and automatic backups. Is it worth your time? Does it offer any unique features?  Affinity Photo is an excellent app for those who want to take exciting photos without spending a lot of time or money. That said, Affinity Photo has some unique features that put it above others in the photo editing world.  One of the main advantages of Affinity Photo is that it allows you to import your images directly into the software without having to go through a tedious setup process. This is especially helpful if you are new to photography and need some help learning how to take good photos.  Another feature that Affinity Photo has over other photo editing apps is its automatic corrections. You can select individual colors or settings from your image and see exactly what they would look like in real life without worrying about manually adjusting them afterward.',
                'logo' => asset('img/logo/50x50/affinity-photo_50x50.png'),
                'link_1' => 'https://affinity.serif.com/en-gb/photo/',
                'platforms' => 'windows,mac,ios',
                'image_1' => "https://digitalfilms.files.wordpress.com/2015/08/df3315_affinity_1.jpg",
                'video_1' => "",
                'publisher_slug' => 'serif',
                'entity_type' => 'software',
                "tags" => ["graphic design", "photo editing"]
            ],
            [
                'slug' => 'mypaint',
                'title' => 'MyPaint',
                'short_description' => 'MyPaint is free, open-source, painting software. ',
                'description' => 'MyPaint is a graphics editor that is commonly used for digital painting. You will find this in many operating systems such as macOS, Windows, and many more. As a digital painter, this is very useful each time you need to make some quick sketches or any complex drawing on your computer. What\'s so interesting about this application is the fact that it is easier to use and simple therefore suitable for beginners. It no complex menus so you can concentrate on your drawings more. MyPaint also contains a wide range of brushes that are organized into varied categories. MyPaint makes it easier to configure any of the brushes to a smaller detail or come up with a new category in a more convenient way. Each brush always has a different result. It is recommended to use it on a tablet though you can as well use it with a standard mouse. Since it supports a wide range of pressure, you will be feeling like a real painter at the end. ',
                'logo' => asset('img/logo/50x50/mypaint_50x50.png'),
                'link_1' => 'http://mypaint.org/',
                'platforms' => 'windows,mac,linux',
                'image_1' => "https://sourcedigit.com/wp-content/uploads/2017/01/mypaint-2017.jpg",
                'video_1' => "",
                'publisher_slug' => '',
                'entity_type' => 'software',
                "tags" => ["graphic design", "photo editing"]
            ],
            [
                'slug' => 'pixelmator',
                'title' => 'Pixelmator',
                'short_description' => 'PixelMator is a suite of image editing tools for MacOS.',
                'description' => 'Pixelmator is a graphics editor that was developed for macOS. It has several features such as selection, painting, color correction, retouching, layer-based image editing, and many more. Pixelmator image editor is suitable for editing images using the most professional tools. It makes use of technologies such as Automator and Core Image for the best results. Moreover, it has more than 40 tools to aid you throughout the editing process. You can use it on your iPhone or iPad. It has over 30 adjustments making it suitable for professional photographers. The only problem with Pixelmator is the fact that it does not support exporting from CYMK, which is a necessary feature each time you are printing out some work. It has a color profile that enables you to check on the emulation of colors that you would like to be printed, however, it does not cut it professionally. So, for any mobile device, you can always go for this photo editing app.',
                'logo' => asset('img/logo/50x50/pixelmator_50x50.png'),
                'link_1' => 'https://www.pixelmator.com/pro/',
                'platforms' => 'mac,ios',
                'image_1' => "https://blog-cdn.pixelmator.com/vectormator_blog.png",
                'video_1' => "",
                'publisher_slug' => '',
                'entity_type' => 'software',
                "tags" => ["graphic design", "photo editing"]
            ],
            [
                'slug' => 'photoscape',
                'title' => 'PhotoScape',
                'short_description' => 'PhotoScape is photo-editing software with a fun, simplistic approach.',
                'description' => 'PhotoScape is a free to download program enjoyed by many people. It can edit the photos and make them look better in real time. That is a smart strategy and one that has worked for many people. Users will get access to top rated tools that can be employed. Even pro photographers will find some use with the new program. It will be installed in a short amount of time as well. Trust that PhotoScape is well worth the time it takes to find and then download on a PC.  Understand that updates are frequently issued for PhotoScape. Those same updates will keep new functions working for a longer time period. The new updates are enacted and the software becomes more useful in time. The PhotoScape program is rapidly becoming a top request among the people. New users will want to read the help files. That shows what to activate.',
                'logo' => asset('img/logo/50x50/photoscape_50x50.png'),
                'link_1' => 'http://www.photoscape.org/ps/main/index.php',
                'platforms' => 'windows,mac',
                'image_1' => "",
                'video_1' => "https://youtu.be/o57tNe4vgIw",
                'publisher_slug' => '',
                'entity_type' => 'software',
                "tags" => ["graphic design", "photo editing"]
            ],
            [
                'slug' => 'draw-io',
                'title' => 'draw.io',
                'description' => 'Draw.io is a free web application that makes it easy to create beautiful and engaging flowcharts and diagrams. It was created in 2000 by Gaudenz Alder who wanted to create a user-friendly solution for business people to communicate their ideas simply and effectively.  All you have to do is pull up your web browser and navigate to draw.io where you can select from a variety of locations to store your diagram. You can save it to your own device, Google Drive, Dropbox, or any other cloud storage.  Once your select your storage platform and create a new diagram, you can select from a wide variety of premade flowchart templates to organize virtually any type of information. There are templates for everything from basic flow charts to business organization charts to engineering schematics.  Once you\'ve selected a template you are launched into a full editing suite where you can edit your diagram\'s shape, size, text, color, and even import your own images to bring your ideas to life.',
                'logo' => asset('img/logo/draw-io.png'),
                'link_1' => 'http://draw.io',
                'platforms' => 'windows,mac',
                'image_1' => "",
                'video_1' => "",
                'publisher_slug' => '',
                'entity_type' => 'software',
                "tags" => ["graphic design", "flowchart", "diagram", 'uml']
            ],
            [
                'slug' => 'xmind',
                'title' => 'xMind',
                'description' => 'XMind is a software which executes mind mapping and brainstorming capabilities. It was developed by XMind Ltd.  Included with the management elements are functionalities like thinking clarification, idea capture, management of intricate information, and the promotion of team collaboration.  There is a free version wherein users can insert markers, notes, hyperlinks, stickers and labels into the topics. Users can also get the mind map which could come in the form of either PDF or PNG with a watermark.  The paid version comes with the features of the free version but dispenses additional benefits. Users can insert attachments, equations and pictures into the mind map. They could set passwords and transport the map without a watermark. More features are being planned in the future to be added.  The paid version of XMind comes in handy for the execution of commercial purposes for offices and companies. This software makes your team\'s work much more efficient and faster to accomplish.',
                'logo' => asset('img/logo/xmind.png'),
                'link_1' => 'http://xmind.net',
                'platforms' => 'windows,mac,ios,linux,android',
                'image_1' => "",
                'video_1' => "",
                'publisher_slug' => '',
                'entity_type' => 'software',
                "tags" => ["diagram", 'mindmap', 'brainstorm', 'flowchart']
            ],
            [
                'slug' => 'gleek-io',
                'title' => 'Gleek.io',
                'description' => 'Gleek.io is a sophisticated web application that allows software developers to create visual diagrams that organize and categorize information in a simplified way. It was created in 2019 by Blockshop which wanted to create a more streamlined workflow for developers to be able to create diagrams.  Gleek\'s approach to creating diagrams is text-based and does away with the need for a mouse. All of the nodes and connections in the diagrams are created by using text commands. This gives you more of a feel of actually coding the diagram instead of dragging and dropping images.  Gleek\'s algorithm is able to automatically organize these commands in a visual way to create symmetrical and concise diagrams. The diagram will automatically resize and position itself based on the code you write without ever having to touch your mouse.  Gleek is free to get started with limited features, and you can export in PNG format only. The premium version starting at $9.95 per month offers the ability to export high-resolution images, an unlimited number of diagram nodes, cloud storage, custom themes, and priority support from the developer.',
                'logo' => asset('img/logo/gleek-io.png'),
                'link_1' => 'http://gleek.io',
                'platforms' => 'web',
                'image_1' => "",
                'video_1' => "",
                'publisher_slug' => '',
                'entity_type' => 'software',
                "tags" => ["diagram", 'mindmap', 'brainstorm', 'uml', 'flowchart']
            ],
            [
                'slug' => 'yed-graph-editor',
                'title' => 'yEd Graph Editor',
                'description' => 'yEd Graph Editor is a free program that allows professionals to create diagrams that organize and process information effectively. It was created in 2010 by the company yWorks who wanted to make a user-friendly application that professionals can use to create diagrams.  With yEd\'s powerful software you can create anything from flowcharts to family trees to complex software algorithm structures. The drag and drop control system allows for a user-friendly experience to simply organize even the most complex ideas.  yEd can even import data from Microsoft Excel and visually organize that data with much more ability for customization than you would get natively with Excel. You can export your diagrams in JPEG, XML, PDF, and many other formats for easy integration into word documents and the internet.  yEd is available for Windows, Mac, and Linux, and all the diagrams you create can be used for both personal and commercial use.',
                'logo' => asset('img/logo/yed-graph-editor.png'),
                'link_1' => 'https://www.yworks.com/products/yed',
                'platforms' => 'web',
                'image_1' => "",
                'video_1' => "",
                'publisher_slug' => 'yworks',
                'entity_type' => 'software',
                "tags" => ["diagram", 'mindmap', 'brainstorm', 'uml', 'flowchart']
            ],
            [
                'slug' => 'lucidchart',
                'title' => 'LucidChart',
                'description' => 'LucidChart is a web app written in HTML 5 that creates diagrams and flowcharts. It was created in 2008 by Lucid Software Inc. for professionals who want to simply create diagrams that they can easily share with other members of their organization.  LucidChart has a unique feature that allows multiple people to work on a diagram at the same time. It integrates flawlessly with Slack, Salesforce, Office 365, and virtually every other collaborative software application so that teams can easily work together to sort out their ideas.  This software uses a drag and drop method to create diagrams. You and your team can start from scratch to build a diagram together, or there are a variety of templates already available that you can use to get started with.  LucidChart is a free application with some small limitations. If you want your team to be as involved as possible, you\'ll want to get a Team account for $9.00 per user which includes advanced collaboration and integration features, thousands of templates, and an unlimited number of editable documents.',
                'logo' => asset('img/logo/lucidchart.png'),
                'link_1' => 'https://www.lucidchart.com',
                'platforms' => 'web',
                'image_1' => "",
                'video_1' => "",
                'publisher_slug' => 'lucidchart',
                'entity_type' => 'software',
                "tags" => ["diagram", 'mindmap', 'brainstorm', 'uml', 'flowchart']
            ],
            [
                'slug' => 'plantuml',
                'title' => 'PlantUML',
                'description' => 'PlantUML is a free software application available for Windows, Mac, and Linux that makes it easy for software developers to create sequence diagrams. It was created in 2009 by Amaud Roques who desired to make an easier way for developers to create complex UML sequences.  PlantUML makes it easy to make edits to complex diagrams without having to delete the whole diagram and start over. Its flexible algorithm makes every piece of the diagram its own entity so that one tiny change does not affect the entire diagram.  PlantUML has drag and drop capabilities, but you can also bring up the source code of your diagram to code in specific actions in order to fine-tune your diagram. The entire project is open-source which has allowed developers all over the world to modify the software to their liking or add new templates that other developers can use within their own project.',
                'logo' => asset('img/logo/plantuml.png'),
                'link_1' => 'https://plantuml.com/',
                'platforms' => 'web',
                'image_1' => "",
                'video_1' => "",
                'publisher_slug' => 'lucidchart',
                'entity_type' => 'software',
                "tags" => ["diagram", 'uml']
            ],
            [
                'slug' => 'omnigraffle',
                'title' => 'omnigraffle',
                'description' => 'OmniGraffle is an application available for Mac and iOS which allows people to make complex diagrams and flowcharts. The 7th version of this software was released in 2020 by OmniGroup. OmniGroup started as a consulting company in 1994, but they found they could better serve their clients by creating productivity software and consulting them on the back end.  OmniGraffle forgoes the fancy graphics and complex methods similar programs use to create flow charts. It\'s perfect for the professional who wants to simply get a complex idea down clearly and concisely.  The editor is packed with an assortment of tools at your disposal to quickly resize, reshape, orientate, and add connections to your diagram. The power of this software is really highlighted in its ability to seamlessly splice one element of the diagram to another and instantly rejoin connections without having to start the entire diagram over.  An OmniGraffle subscription starts at $12.49 per month or $124.99 per year. A 14-day limited free trial is also available to test out the software.',
                'logo' => asset('img/logo/omnigraffle.png'),
                'link_1' => 'https://www.omnigroup.com/omnigraffle',
                'platforms' => 'web',
                'image_1' => "",
                'video_1' => "",
                'publisher_slug' => 'ominigroup',
                'entity_type' => 'software',
                "tags" => ["diagram", 'uml', 'prototyping', 'flowchart', 'mindmap']
            ],

        ], 'graphic-design');
    }


    private
    function seedPrivacySecurity()
    {
        $this->entitySeederLoop([
            [
                'title' => 'Sandboxie',
                'slug' => 'sandboxie',
                'description' => 'Sandboxie is free software that allows you to emulate your Windows operating system, and install and run programs in a test environment without them having access to your full computer. This makes it easy to run programs that you are unsure about in case they have viruses or other harmful software.  Sandboxie is great for people who want to experiment with various 3rd party software such as a programmer who would like to test out code that may modify important system configuration, but it would do so in a virtual environment and have no effect on your actual system. It was developed by David Xanatos in 2004 and it\'s compatible with Windows 7 and later.  Sandboxie is actually now open source which gives anyone who is interested full access to its source code. With access to this source code, you and other developers can modify the software for a more customized virtual experience.',
                'logo' => asset('img/logo/sandboxie.png'),
                'link_1' => '//sandboxie.com',
                'platforms' => 'windows,mac,linux,web,android,ios',
                'publisher_slug' => 'cloudflare',
                'entity_type' => 'software',
                "tags" => ["virtualization", "sandbox", "security software"]
            ]
        ], 'security-privacy');
        $this->entitySeederLoop([
            [
                'title' => 'L7 Defense',
                'slug' => 'l7-defense',
                'description' => 'L7 Defense is an application that protects businesses against hackers that steal money from your customers through microtransactions. It was developed in Israel in 2015.  Hackers commit small-scale fraud by bombarding an organization with consistent attacks that siphon off small amounts as low as $0.02 from large transactions that may be upwards of thousands of dollars hoping that customers won\'t notice. Usually, your company won\'t even notice what is happening until it is too late and you are met with a long list of customer complaints about these transactions.  L7 Defense stops this from happening by noticing and blocking these attacks in real-time. Since your organization is consistently being bombarded with attacks you cant see, the money can be stolen from your customers within seconds from the time the transaction is made.  L7 works in a reverse way by consistently monitoring the transactions done by an organization so that attacks are instantly detected and stopped right in their tracks.',
                'logo' => asset('img/logo/l7-defence.avif'),
                'link_1' => '//sandboxie.com',
                'platforms' => 'web',
                'publisher_slug' => 'cloudflare',
                'entity_type' => 'software',
                "tags" => ["waf", "firewall", "api firewall", "ddos protection"]
            ],
            [
                'title' => 'Sucuri',
                'slug' => 'sucuri',
                'description' => 'Sucuri is a web application that closely monitors your website in order to protect it from hackers. It was created in 2010 by Daniel B Cid and is now owned by GoDaddy.  It is available as a WordPress plugin, or it can be installed as a CDN onto any website. It includes a powerful firewall that consistently monitors your website so that it detects any attacks before they can cause harm to your site.  They have a team of security experts that work around the clock to defend against the most up-to-date malware and DDoS attacks. These experts do a full scan of your website every 30mins - 12 hours depending on which plan you have.  Once malware is detected on your website, an expert will remove it within 30 hours. This is really a must-have for any website owner who deals with a high volume of traffic that collects or stores sensitive user information such as credit card numbers or other personal information.  Sucuri plans start at $199.99 per year per site and they have special discounts for multi-site plans and custom installations.',
                'logo' => asset('img/logo/sucuri.png'),
                'link_1' => '//sucuri.com',
                'platforms' => 'web',
                'publisher_slug' => 'sucuri',
                'entity_type' => 'software',
                "tags" => ["waf", "firewall", "ddos protection", "wordpress firewall", "cdn"]
            ],
        ], 'firewall');
        $this->entitySeederLoop([
            [
                'title' => 'Cloudflare',
                'slug' => 'cloudflare',
                'description' => 'CloudFlare is a web performance and security company that was founded in 2009 by Matthew Prince. It offers users the ability to improve the performance of their website by caching static files and blocking malicious traffic.  Other features that CloudFlare offers include the ability to protect your website from DDoS attacks, increase the security of your website with SSL/TLS, and improve the performance of your website with its global CDN.  What makes CloudFlare unique is that it offers a wide range of features for free. It is perfect for businesses who are looking to improve the performance and security of their website. It also has a wide range of integrations with other applications, such as content management systems (CMS) and e-commerce platforms.  It is available as a plugin for WordPress, Drupal, Joomla, and Shopify. You can also get started with CloudFlare\'s free plan. Paid subscription offers additional features, such as increased security and performance.',
                'logo' => asset('img/logo/cloudflare.png'),
                'link_1' => '//cloudflare.com',
                'platforms' => 'web',
                'publisher_slug' => 'cloudflare',
                'entity_type' => 'software',
                "tags" => ["cdn", "ddos protection"]
            ],
            [
                'title' => 'KeyCDN',
                'slug' => 'keycdn',
                'description' => 'KeyCDN is a content delivery network that increases the speed and functionality of your website. It was created in 2012 by swiss developers Sven Baumgartner and Jonas Krummenacher.  KeyCDN makes your website blazing fast by hosting your images, audio, video on a content network instead of on your website server. The network will deliver these items to the user as needed instead of having to load the entire website at once.  It also makes your website extremely secure. It protects your website from DDoS attacks, blocks bad bots, and enables two-factor authentication.  This is a must-have for large-scale companies that deal with a large amount of data and website traffic. The network automatically organizes and protects all of that data so that the end-user has the best possible experience on your website.  KeyCDN in North America starts at $0.04 per GB for the first 10TB that is accessed from your site and goes down as your website transmits more data.',
                'logo' => asset('img/logo/keycdn.png'),
                'link_1' => '//keycdn.com',
                'platforms' => 'web',
                'publisher_slug' => 'keycdn',
                'entity_type' => 'software',
                "tags" => ["cdn", "ddos protection"]
            ],
            [
                'title' => 'Akamai',
                'slug' => 'akamai',
                'description' => 'Akamai is an American delivery network that handles cybersecurity and cloud service that provides internet security services. It was founded in 1998 by Daniel Lewin. They are one of the largest distributed computing networks in the world, their primary service is the operation of network servers ranging from internet service providers, and telecommunications. The type of clients they handle is usually internet users and telecommunication companies. Ensuring that the travel of communication and data will always be on track and on time to prevent any lag during the internet browsing and so as the line of communications, the lines are always connected even at a power disruption. They have been in the industry for at least 24 years making them a legend and they have already established trust with their clients and the government, payment plans are flexible for consumers making them a consumer-friendly tech company that would do anything to make their customers happy and satisfied.',
                'logo' => asset('img/logo/akamai.png'),
                'link_1' => '//akamai.com',
                'platforms' => 'web',
                'publisher_slug' => 'akamai',
                'entity_type' => 'software',
                "tags" => ["cdn", "ddos protection"]
            ],
        ], 'cdn');
    }

    private
    function seedSocialCommunications(): void
    {
        $this->entitySeederLoop([
            [
                'title' => 'WeChat',
                'description' => 'WeChat is a brand new program that helps users communicate. Chat with other people and enjoy the user experience now online. Over 17 different languages are featured with the WeChat program as well. The program can be customized in a lot of new ways too. The WeChat program helps people learn all of the new features to trust. The WeChat program is a big asset to the growing user base these days too.  The next step ought to be reading up on the user reviews. Other people have given the program a chance so far. The software was released back in 2011 and became the largest of its kind in 2018. The WeChat program continues to lead the way in to the future. Write a new review and support the development team in good time. WeChat is going to be a leader and people want it to success if possible.',
                'logo' => asset('img/logo/50x50/wechat_50x50.png'),
                'slug' => 'wechat',
                'link_1' => 'https://wechat.com',
                'platforms' => 'android,ios,mac,windows',
                'image_1' => "https://www.androidpolice.com/wp-content/themes/ap2/ap_resize/ap_resize.php?src=https%3A%2F%2Fwww.androidpolice.com%2Fwp-content%2Fuploads%2F2020%2F05%2Fwechat-hero.png&w=728",
                'video_1' => "",
                'publisher_slug' => 'tencent',
                'entity_type' => 'software',
                "tags" => ["instant messenger", "chat", "video calling", "video chat"]
            ],
            [
                'title' => 'Discord',
                'short_description' => 'Discord is a chat app, similar to programs such as Skype or TeamSpeak, or professional communications platforms like Slack',
                'description' => 'Discord is a relatively new VoIP (voice over internet protocol) software application created in May of 2015 by two developers, Jason Citron and Stan Vishnevskiy. It\'s currently used by millions of people all over the world and has been growing in popularity at a very fast rate.  Discord is different from other VoIP applications in that it was designed specifically for gamers. It offers features like voice and video calling, text chat, and server and client voice chat, perfect for gaming communities.  Since the pandemic, Discord has been popularized for school and work communication because of its ability to host large group chats with no limit on the number of participants, clear voice and video quality, and the ability to share files and screens.  Discord is free to use for all users, but offers a paid subscription service with more advanced features called Discord Nitro. Available on Windows, Mac, Linux, Android, iOS, and web browsers.',
                'logo' => asset('img/logo/50x50/discord_50x50.png'),
                'slug' => 'discord',
                'link_1' => 'https://discord.com',
                'platforms' => 'android,ios,mac,windows,linux,web',
                'image_1' => "https://www.protocol.com/media-library/eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpbWFnZSI6Imh0dHBzOi8vYXNzZXRzLnJibC5tcy8yNDYyOTc5Ny9vcmlnaW4ucG5nIiwiZXhwaXJlc19hdCI6MTYxMDQ3Nzk0N30.hdPJCdt9IMUA2V4oOVRnNLG-GAIUQWh92UqrHLShMQQ/image.png",
                'video_1' => "",
                'publisher_slug' => 'discord',
                'entity_type' => 'software',
                "tags" => ["instant messenger", "chat", "video calling", "video chat"]

            ],
            [
                'title' => 'Facebook Messenger',
                'description' => 'Facebook Messenger is a truly fantastic app. It\'s so good, it has users all over the world. It can do so much for a business that you are in. Almost every business out there wants to communicate with their customers more effectively. They want faster turnaround times, more personalization, and better customer interaction. So why not harness the power of Facebook Messenger?  Facebook Messenger Bots can help your business do just that — make it easier for your customers to engage with you, reach out to you, schedule meetings with you, pay bills or other purchases with you, and much more.  By creating Facebook Messenger bots in the backend of your website or app, you can direct interested visitors to your Facebook page. If they decide they like what they see on your page, they might visit your website or app to learn more about your business and its products or services—and then potentially become a paying customer.',
                'logo' => asset('img/logo/50x50/facebook-messenger_50x50.png'),
                'slug' => 'facebook-messenger',
                'link_1' => 'https://www.messenger.com/',
                'platforms' => 'web,android,ios,mac,linux,windows',
                'image_1' => "https://cdn.vox-cdn.com/thumbor/OYzF8X9Wcn9z_sgr5aA9FdoTPbs=/0x0:3200x2200/1200x800/filters:focal(1344x844:1856x1356)/cdn.vox-cdn.com/uploads/chorus_image/image/62868978/Messenger_4___3_Tabs___Android.0.png",
                'video_1' => "",
                'publisher_slug' => 'facebook',
                'entity_type' => 'software',
                "tags" => ["instant messenger", "chat", "video calling", "video chat"]

            ],
            [
                'title' => 'Kik',
                'description' => 'Created by Ted Livingston, founder and CEO of the company Kik Interactive, Kik is a mobile messaging application that is free to use and can be downloaded on both iPhone and Android. Targeted to a teenage and young adult audience, the main features of the Kik app include an original username, one-on-one chatting as well as group chats with up to 49 users, the ability to send messages, images, videos, and GIFs, anonymous messaging, and promoted chats, which allow members to chat with verified musicians and other entertainers. Although the app is similar to other messaging apps such as WhatsApp and Viber, the Kik app has some original features that make it stand out, with its defining feature being an internal browser. Through the apps\'s internal browser, users can download add-ons such as games, dating apps, sticker apps, quizzes to play with friends, news, and meme generators. The Kik app currently has an age restriction set to ages 17 and up to download on both the App Store and the Google Play store.',
                'logo' => asset('img/logo/50x50/kik_50x50.png'),
                'slug' => 'kik',
                'link_1' => 'https://www.kik.com/',
                'platforms' => 'android,ios',
                'image_1' => "https://images.macrumors.com/t/G-fqfDbTqTgdjTbaBsNyxBNQ-_4=/1600x900/smart/article-new/2019/09/kik.jpg",
                'video_1' => "",
                'publisher_slug' => 'kik-interactive',
                'entity_type' => 'software',
                "tags" => ["instant messenger", "chat", "video calling", "video chat"]
            ],
            [
                'title' => 'Slack',
                'description' => 'Slack was created in 2013 by Stewart Butterfield and two of his colleagues. It is a messaging app that allows users to communicate with one another through chat rooms. What makes Slack unique is its focus on team collaboration. It\'s often used by businesses as a way to communicate with their employees. Since its creation, Slack has become one of the most popular messaging apps in the world. Primarily used for team and business communications, its versatility and the ability to create custom and multiple channels make it the perfect platform for a wide variety of users. It has become more popular for those businesses with remote employees, as it allows for an easier way to communicate and collaborate. Slack is available on a variety of devices, including computers, smartphones, and tablets. It has over 12 million active users and is used by over 85,000 businesses. Slack is available on a variety of devices, including computers, smartphones, and tablets.',
                'logo' => asset('img/logo/50x50/slack_50x50.png'),
                'slug' => 'slack',
                'link_1' => 'https://slack.com/',
                'platforms' => 'android,ios,mac,linux,windows',
                'image_1' => "https://miro.medium.com/max/3376/1*P6-ge5hK-EjLr4W_IVLxZQ@2x.png",
                'video_1' => "",
                'publisher_slug' => 'slack',
                'entity_type' => 'software',
                "tags" => ["instant messenger", "chat"]
            ],
            [
                'title' => 'Skype',
                'short_description' => 'Skype has been around since 2003 when it was launched by two Finnish entrepreneurs, Janus Friis and Netscape-cofounder Niklas Zennström. The idea behind Skype came about because Niklas wanted international phone service at the lowest cost possible, but he couldn\'t find any existing services that met his requirements. So they created one themselves - originally called Skyper, but later changed to Skype because Skyper was already trademarked and the domain name wasn\'t available for purchase.  Skype is a software application that allows you to make voice and video calls over the internet. It\'s free to download and use and is popular among businesses for its crisp sound quality and ability to hold large group conferences. Skype also offers a paid subscription service that allows you to call regular landlines and cell phones at low rates.  Skype is available for Windows, Mac, Linux, Android, iOS, and other platforms. It can be used on desktops, laptops, tablets, or smartphones.',
                'description' => 'Skype has been around since 2003 when it was launched by two Finnish entrepreneurs, Janus Friis and Netscape-cofounder Niklas Zennström. The idea behind Skype came about because Niklas wanted international phone service at the lowest cost possible, but he couldn\'t find any existing services that met his requirements. So they created one themselves - originally called Skyper, but later changed to Skype because Skyper was already trademarked and the domain name wasn\'t available for purchase.  Skype is a software application that allows you to make voice and video calls over the internet. It\'s free to download and use and is popular among businesses for its crisp sound quality and ability to hold large group conferences. Skype also offers a paid subscription service that allows you to call regular landlines and cell phones at low rates.  Skype is available for Windows, Mac, Linux, Android, iOS, and other platforms. It can be used on desktops, laptops, tablets, or smartphones.',
                'logo' => asset('img/logo/50x50/skype_50x50.png'),
                'slug' => 'skype',
                'link_1' => 'https://www.skype.com/',
                'platforms' => 'android,ios,mac,linux,windows',
                'image_1' => "https://channelvisionmag.com/wp-content/uploads/2017/05/skype-for-business.png",
                'video_1' => "",
                'publisher_slug' => 'microsoft',
                'entity_type' => 'software',
                "tags" => ["instant messenger", "chat", "video calling", "video chat"]

            ],
            [
                'title' => 'Snapchat',
                'description' => 'Snapchat is a popular app for iOS and Android devices. Founded on July 8, 2011, the service has garnered immense attention from users across the world. Bobby Murphy, Evan Spiegel, and Reggie Brown started Snapchat to encourage an instant and natural flow of communication/interaction.  The beauty of Snapchat is that any video, message, or picture that you send becomes available to its receiver for a short time before it gets inaccessible. Initially started as a person-to-person picture-sharing app, Snapchat now offers a myriad of options, including the submission of short videos, messaging, live video chatting, and creating caricature avatars and stories. Users can also tap a Discovery area that shows short-form content from leading publishers such as Buzzfeed.  Snapchat also allows you to store media in a private area. Other options include the user’s ability to add AR-based lenses and filters to photos and show live location on a world map. Despite these additions, Snapchat is all about instant communication through a cell phone.',
                'logo' => asset('img/logo/50x50/snapchat_50x50.png'),
                'slug' => 'snapchat',
                'link_1' => 'https://www.snapchat.com/',
                'platforms' => 'android,ios',
                'image_1' => "https://miro.medium.com/max/13000/1*HBUQ2bhLESQFkTObtGgEIg.jpeg",
                'video_1' => "",
                'publisher_slug' => 'snapchat',
                'entity_type' => 'software',
                "tags" => ["instant messenger", "chat", "photo sharing"]

            ],
            [
                'title' => 'Telegram',
                'short_description' => 'Telegram is an encrypted instant messaging and voice over IP service that runs in the cloud.',
                'description' => 'Telegram is a free messaging app with a focus on security and speed. It was created by two Russian brothers, Nikolai and Pavel Durov, in August of 2013.  What makes Telegram stand out from other messaging apps is its emphasis on security. Messages are encrypted using a powerful algorithm that makes them virtually impossible to hack, and there is an option to set a self-destruct timer for messages so that they are automatically deleted after a certain amount of time.  Telegram also claims to be the fastest messaging app in the world, with messages being sent and received almost instantly. It\'s available for Android, iOS, Windows Phone, MacOS, and Linux.  This messaging app is being widely used by businesses for its speed and security features. It\'s a great option for anyone who wants to keep their communications private. Its open API also makes it possible to create custom bots and integrations.',
                'logo' => asset('img/logo/50x50/telegram_50x50.png'),
                'slug' => 'telegram',
                'link_1' => 'https://telegram.org/',
                'platforms' => 'android,ios,mac,linux,windows',
                'image_1' => "https://cdn.dnaindia.com/sites/default/files/styles/full/public/2020/10/02/928680-telegram.jpg",
                'video_1' => "",
                'publisher_slug' => 'telegram',
                'entity_type' => 'software',
                "tags" => ["instant messenger", "chat", "photo sharing", "video chat", "group chat", "video calling", "screen sharing"]

            ],
            [
                'title' => 'Viber',
                'short_description' => 'Viber is a cross-platform VOIP, instant messaging software application from Rakuten.',
                'description' => 'Viber is a free messaging and calling app that was created by Israeli entrepreneur Talmon Marco in 2010. It was originally created to provide a solution for people who are in a long-distance relationship. In 2014, the messaging platform was purchased by Rakuten.  What makes Viber unique among messaging apps is its focus on crystal clear voice calls. In addition to messaging, Viber also allows its users to share media, including photos and videos, and create group chats that can accommodate up to 250 members.  It also has a paid subscription service called Viber Out that allows users to call regular landlines and cell phones at low rates.  Viber is popular among young people for its social features, stickers, and group chats. It\'s also been gaining popularity among businesses for its low-cost VoIP calling service.  Today, it is now considered one of the go-to internet-based messaging platforms that\'s available for both Android and iOS devices.',
                'logo' => asset('img/logo/50x50/viber_50x50.png'),
                'slug' => 'viber',
                'link_1' => 'https://www.viber.com/',
                'platforms' => 'android,ios,mac,linux,windows',
                'image_1' => "https://cwpwp2.betterthanpaper.com/wp-content/uploads/2020/02/Viber-My-Notes.jpg",
                'video_1' => "",
                'publisher_slug' => 'rakuten',
                'entity_type' => 'software',
                "tags" => ["instant messenger", "chat", "video calling", "video chat"]
            ],
            [
                'title' => 'WhatsApp',
                'description' => 'WhatsApp, is a freeware, cross-platform messaging and VOIP service from Facebook. It lets users send text and voice messages, make voice and video calls, and share their locations and multimedia.',
                'logo' => asset('img/logo/50x50/whatsapp_50x50.png'),
                'slug' => 'whatsapp',
                'link_1' => 'https://www.whatsapp.com/',
                'platforms' => 'android,ios,mac,web,windows',
                'image_1' => "https://therealrepaircompany.co.za/wp-content/uploads/2020/02/Enhance-Your-WhatsApp-Security-2.jpg",
                'video_1' => "",
                'publisher_slug' => 'facebook',
                'entity_type' => 'software',
                "tags" => ["instant messenger", "chat", "video calling", "video chat", "group chat"]
            ],
            [
                'title' => 'TinyChat',
                'short_description' => 'tinychat',
                'description' => 'TinyChat is an online chat community that uses voice chat, instant messaging, and video chat to communicate and find friends. Tiny Chat was co-founded by Martin Redmond, Blake Saltman, and Cole Turner in February 2009. PeerStream was the owner of this platform until it was acquired by Paltalk in 2014 and continues to remain as a standalone application. Its headquarters is based in New York.  One of the best features of TinyChat is you can chat with up to 12 people in one room via video chat. You can do recording, screen sharing, and the opportunity to connect through Facebook, It also upgraded its video chat to HD version in 2017. You can choose between people near you for common chats or the most gifted people to join in an interesting chat. Explicit content will be restrained by moderators. You can also purchase and send or receive gifts in the virtual store. By doing this you can earn points and coins which you can use to promote your room. TinyChat can be used on PC, iOS, and Android phones. Although it is free to join, you need to be a paying customer to use some of its features.  You must be above 13 years of age to join this amazing platform.',
                'logo' => asset('img/logo/tinychat.png'),
                'slug' => 'tinychat',
                'link_1' => 'https://www.tinychat.com/',
                'platforms' => 'web',
                'image_1' => "",
                'video_1' => "",
                'publisher_slug' => 'tinychat',
                'entity_type' => 'software',
                "tags" => ["instant messenger", "chat", "video calling", "video chat", "group chat", "random video chat", "live broadcasting"]
            ]
        ], 'social-communications');
        $this->entitySeederLoop([
            [
                'title' => 'Instagram',
                'slug' => 'instagram',
                'description' => 'Instagram was created in 2010 by two founders, Kevin Systrom and Mike Krieger. It is a photo and video sharing app that allows users to share their photos and videos with the world. It was one of the first photo sharing and editing apps that introduced the use of filters.  What makes Instagram unique is its focus on engagement. Unlike other social media networks like Facebook and Twitter, Instagram is a primarily visual platform. It also introduced disappearing stories, which was later copied by other social media networks.  Originally, the said platform was only available to both Android and iOS devices - but it was recently introduced to desktop browsers. In 2012, Facebook purchased Instagram for $1 billion, shockingly with only 13 employees. Since then, it has continued to grow in popularity and now has over one billion active users.  Instagram (IG) is now famous for influencers, businesses, bloggers, and even friends to connect with one another. It\'s a great platform for creative people, brands, or businesses to build an audience around their passions.',
                'logo' => asset('/img/logo/instagram.png'),
                'link_1' => 'https://instagram.com',
                'platforms' => 'windows,mac,linux,web,android,ios',
                'publisher_slug' => 'facebook',
                'entity_type' => 'software',
                "tags" => ["Photo Sharing", "Photo Editing", "Social Network"]
            ],
            [
                'title' => 'Facebook',
                'slug' => 'facebook',
                'description' => 'Facebook, which began in Mark Zuckerberg\'s Harvard dorm room in 2004, is now worth billions of dollars and is one of the world\'s most recognizable brands. It\'s even gotten a Hollywood makeover, with The Social Network, a film about the site\'s creation, released to critical acclaim in 2011.  Facebook is a platform that allows users people to make personal profiles and connect with their friends, colleagues/co-workers, and random people online. Users can also post as many photographs, music, videos, and articles as they wish, as well as their personal thoughts and beliefs.  Users can send "friend requests" to persons they know or people they don\'t know. People who have profiles provide details about themselves. Many users share a lot of information that is easily visible to their friends and others, whether it be what they work at, where they study, their ages, or other personal details.',
                'logo' => asset('/img/logo/facebook.png'),
                'link_1' => 'https://facebook.com',
                'platforms' => 'windows,mac,linux,web,android,ios',
                'publisher_slug' => 'facebook',
                'entity_type' => 'software',
                "tags" => ["Photo Sharing", "Social Network"]
            ],
            [
                'title' => 'Twitter',
                'slug' => 'twitter',
                'description' => 'Twitter was founded in 2006 by Evan Williams, Biz Stone, and Noah Glassex, with Jack Dorsey as the executive director of the company, many of them were previously workers of the well known company Google.  Twitter is a website that enables people through the world to connect with each other, allowing them to submit and read texts as long as 140 characters, which are called tweets. As well as following different users or particular subjects instantly, you can also have your followers and create your own new subjects. While using it, you are able to retweet or leave a like on other users\' tweets, and by doing this that tweets will be shown in your profile and your followers will be able to see it and interact with it (like or retweet) which can make a chain and give users the chance to get high audience levels If they create good content, which from my point of view is the main advantage of this website.  It is a very useful social network that can be used by anyone for many different purposes. With Twitter you are able to learn, stay tuned, leisure, or all of them at the same time.',
                'logo' => asset('/img/logo/twitter.png'),
                'link_1' => 'https://twitter.com',
                'platforms' => 'windows,mac,linux,web,android,ios',
                'publisher_slug' => 'twitter',
                'entity_type' => 'software',
                "tags" => ["Photo Sharing", "Social Network"]
            ],
            [
                'title' => 'Pinterest',
                'slug' => 'pinterest',
                'description' => 'Pinterest was founded in March 2010 by Ben Silbermann, Evan Sharp, and Paul Sciarra. Since then, they\'ve assisted millions of individuals all around the world in discovering new recipes, parenting hacks, style inspiration, and other fun things to try.  Pinterest is a social media site that allows users to aesthetically express and seek alternative interests by pinning pictures or videos to their own or others\' boards (it is a compilation of \'pins\' with a common subject) and viewing what other individuals have pinned.  You can create an account, log in, and either like or make your own posts.  The social network is indeed focused on the idea of a particular person\'s lifestyle, using a visual orientation to allow you to share your hobbies and preferences with others while also discovering those of like-minded individuals. Having billions of Pins to choose from, you\'ll never run out of creative ideas on Pinterest.',
                'logo' => asset('/img/logo/pinterest.png'),
                'link_1' => 'https://pinterest.com',
                'platforms' => 'windows,mac,linux,web,android,ios',
                'publisher_slug' => 'pinterest',
                'entity_type' => 'software',
                "tags" => ["Photo Sharing", "Social Network"]
            ],
        ], "social-networking");
        $this->entitySeederLoop([
            [
                'slug' => 'hootsuite',
                'title' => 'Hootsuite',
                'short_description' => 'One of the most popular social media management platforms in the world.',
                'description' => 'Hootsuite is an online media management tool, designed to help you produce quality content for your social media channels, while generating targeted and relevant traffic. Hootsuite was founded in 2007 by Davey Conrad, a former writer for Fox News who now runs his own social media consultancy.  The most important aspect of Hootsuite is its simplicity. You can get started quickly with very little learning. This is not the case with other marketing tools. You have to understand how to use each piece of the tool to fully utilize all of its features  Hootsuite is a useful tool for managing multiple social accounts, and it has a nice interface. The downside is that it\'s not very well known or used outside the tech industry.  If you are serious about your business, you should consider adding some other features that will help you manage your business’s social media better, like the ability to schedule posts or create Twitterbots.',
                'logo' => asset('/img/logo/hootsuite.png'),
                'link_1' => '//hootsuite.com',
                'platforms' => 'windows,mac,android,ios,web',
                'image_1' => "img/featured/hootsuite.webp",
                'video_1' => "",
                'publisher_slug' => 'hootsuite',
                'entity_type' => 'software',
                'tags' => ['social media automation']
            ],
            [
                'slug' => 'buffer',
                'title' => 'Buffer',
                'short_description' => 'Buffer is a software application for the web and mobile, designed to manage accounts in social networks, by providing the means for a user to schedule posts to Twitter, Facebook, Instagram, Instagram Stories, Pinterest, and LinkedIn, as well as analyze their results and engage with their community.Wikipedia',
                'description' => 'Buffer is an active social media marketing tool that helps you keep the news flowing. Buffer is used by brands and content creators to share news, tips and more.  Buffer is an open-source solution that allows you to publish text, images, videos and links on social media sites like Facebook, Twitter and Tumblr with a click of a button.  Buffer was founded in 2010 by Buffer\'s co-founders Ben Silbermann and Joel Gascoigne as a way for their company to bypass their own internal communications system. They wanted to have a way for everyone at Buffer to express themselves in the form of blog posts or tweets without having to worry about managing communications internally.  Buffersify had its beginnings in 2009 when Ben Silbermann used his personal blog as a platform to post thoughts on Buffer itself, while Joel Gascoigne was inspired by his experience taking Care2\'s Vacation Guide series off the internet and putting it on the Buffer blog.',
                'logo' => asset('/img/logo/buffer.png'),
                'link_1' => 'https://buffer.com/',
                'platforms' => 'windows,mac,android,ios,web',
                'image_1' => "",
                'video_1' => "",
                'publisher_slug' => 'buffer',
                'entity_type' => 'software',
                'tags' => ['social media automation']
            ],
            [
                'slug' => 'share-locker',
                'title' => 'Share Locker',
                'description' => 'Make your content go viral. Lock links. Promote lockers. Get users to share like its going out of fashion.',
                'logo' => asset('/img/logo/share-locker.png'),
                'link_1' => 'https://sharelocker.io/',
                'platforms' => 'windows,mac,android,ios,web',
                'image_1' => "https://sharelocker.io/img/example.png",
                'video_1' => "",
                'publisher_slug' => 'mlxn',
                'entity_type' => 'software',
                'tags' => ['social media automation']
            ],
        ], "social-media-automation");
        $this->entitySeederLoop([
            [
                'title' => 'Omegle',
                'slug' => 'omegle',
                'description' => 'Omegle is a website that is used to chat with another person for free. You do not need to register to join this platform. You will be randomly paired with another person that has the same interest as you are and you can use anonymous names like You, stranger, or stranger 1 in spy mode. The platform was created by Leif K Brooks and was launched on 25th March 2009.  When first launched, it was a text-only platform but video chat was introduced in 2010 which also includes built-in text windows. This site although it has moderators, cannot control the explicit 18+ content in the specific area. So you need to be very careful when talking with strangers. There is also a comment saying " use at your own peril and disconnect if feel uncomfortable. People also can record our chat so that\'s another safety issue you need to think about. Other than that if you need an open talk, looking for fun, and want to make new friends then this is one chat platform you should not miss out on.  Omegle is intended for youngsters 18 and above. Those who are 13 and above must have parental permission to use it. Although there are age restrictions they will not ask for your registration or verification.',
                'logo' => asset('img/logo/omegle.png'),
                'link_1' => '//omegle.com',
                'platforms' => 'windows,mac,linux,web,android,ios',
                'publisher_slug' => 'omegle',
                'entity_type' => 'software',
                "tags" => ["Random Video Chat"]
            ],
            [
                'title' => 'ChatRoulette',
                'slug' => 'chatroulette',
                'description' => 'ChatRoulette was founded in 2009 by a 17 years old Russian student called Andrej Ternowskij, this website went from 500 users to 50.000 in one month, the website sustains thanks to its advertisings as well as a service of online dating.  This website is based on videoconferences, and it allows you to interact with people you didn\'t know from any place around the glove via webcam. When you enter the website you are randomly matched with another person that is also using Chatroulette at that moment, and you are able to interact with that person live. You also have the choice to use a chat with them If you don\'t want to turn on your camera or you don\'t have a microphone.  ChatRoulette can be used for many different purposes, and it became very popular due to many influencers using it for creating funny content, showing their different skills to other people and get their reactions, etc. It can be used for meeting people from other countries and practise other languages, or just for talking with new people from your home.',
                'logo' => asset('img/logo/chatroulette.png'),
                'link_1' => '//chatroulette.com',
                'platforms' => 'windows,mac,linux,web,android,ios',
                'publisher_slug' => 'chatroulette ',
                'entity_type' => 'software',
                "tags" => ["Random Video Chat"]
            ],
            [
                'title' => 'ChatRandom',
                'slug' => 'chatrandom',
                'description' => 'Chatrandom is a video conference based website that was launched in 2011 and already has more than 4 millions users. The website has people from 185 different countries.  This website allows people from every country arould the glove to connect each other via webcam, it is very similar to other websites such as ChatRoulette or Omegle, but in 2014 ChatRandom surpassed ChatRoulette in popularity. As their website states, its main purpose is to make the world a smaller place where you can have the freedom to meet a person that lives on the other side of the planet instantly. Chatrandom matches you with a random person that is using the website at that moment, you don\'t need to turn on your camera If you don\'t want to, you can just use the chat. There are plenty of ways someone could use this website for, you could use it for practising languages, meeting new friends, just for laughs, or maybe for finding your love. The website also gives you the chance to choose the gender you are looking to talk with (Femenine, Masculine, Trans), perfect If you are looking for finding a partner, but If you are just looking for fun or learning a language you can choose to show all genders and you can even choose the country of the people you want to meet.  If you are looking for any of those things you may visit ChatRandom and be surprised with all the new people you can find meet there.',
                'logo' => asset('img/logo/chatrandom.png'),
                'link_1' => '//chatrandom.com',
                'platforms' => 'windows,mac,linux,web,android,ios',
                'publisher_slug' => 'chatrandom ',
                'entity_type' => 'software',
                "tags" => ["Random Video Chat"]
            ],
            [
                'title' => 'MeetMe',
                'slug' => 'meetme',
                'description' => 'MeetMe, previously known as MyYearBook, is a mobile phone app that was created to give users the possibility to meet people with similar interests. It belongs to a group of different apps such as Skout, Tagged or Lovoo. It already has more than 100 million subscribers.  MeetMe is a free to download app that allows its users to meet people of any age or country. Its mechanism is very similar to Tinder\'s, since you are able to give like to other people\'s photos and viceversa, If you pay you download some extra features such as the posibility to see the photos of the users that have given you a like or have visualized your photos, and the removal of adds. In the free version there are some interesting features that have made this app famous, the most popular one is a game where you have to guess the person that have given you a like, remember that in the free version you are not able to see their photos so it\'s pure luck.  If you are looking to meet new people this could be a good option, but try to be careful with ill-intentioned people!',
                'logo' => asset('img/logo/meetme.png'),
                'link_1' => '//meetme.com',
                'platforms' => 'android,ios',
                'publisher_slug' => 'meetme ',
                'entity_type' => 'software',
                "tags" => ["Random Video Chat"]
            ],
            [
                'title' => 'Yubo',
                'slug' => 'yubo',
                'description' => 'Yubo is a mobile phone app that was designed in 2015 by three french engineering students called Sacha Lazimi, Jeremie Aouate and Arthur Patora. The main target of this app are young people and it is available for either Android or iOS, it already has about 40 million users around the world.  This app is usually used by young people as to videochat with each other, and the main features and the causes of its success are that it is free and pretty easy to use, and gives its users the possibility to connect with each other no matter where they are, they just need a smartphone with internet connection. Furthermore, users can change the settings of the apps, choosing the location of the people they want to see, and are also able to accept or deny calls from other users. They can also chat with other individuals or join group chats, and videocalls can support as many as 10 people at the same time, making it a good choice for having digital meets with your friends If you can\'t meet them in person for any reason.  From my point of view this software engloves features from many others, taking the good ones from other similar platforms or websites such as Chatroulette or Google Meet, since you can call either your friends for having a conversation with them or meet a random person.',
                'logo' => asset('img/logo/yubo.png'),
                'link_1' => '//yubo.com',
                'platforms' => 'android,ios',
                'publisher_slug' => 'yubo ',
                'entity_type' => 'software',
                "tags" => ["Random Video Chat"]
            ],
        ], "random-video-chat");
    }

    private
    function seedTorrents(): void
    {
        $this->entitySeederLoop([
            [
                'title' => 'ThePirateBay',
                'slug' => 'thepiratebay',
                'description' => 'The Pirate Bay is an online torrent index that has content from every digital source such as movies, software, ebooks, music, and tv series all in different formats and quality that suites the user\'s taste and needs. Most of the digital content inside the pirate bay is safe and free from viruses, users of this software are usually people who do not have enough budget to purchase a legitimate and original copy of the digital platform due to the financial constraints which is why they prefer to download it and since it is free it is more practical use. All the users need is a torrent application and a reliable internet connection then they can download any digital content they prefer and have it in a couple of minutes. The entire pirate bay is also free and can be easily accessed through web browsing whether on a desktop or in a smartphone device.',
                'logo' => asset('img/logo/the-pirate-bay.png'),
                'link_1' => 'https://www.tpbproxypirate.com/',
                'platforms' => 'web',
                'publisher_slug' => '',
                'entity_type' => 'software',
                "tags" => ["torrent"]
            ],
            [
                'title' => '1337X',
                'slug' => '1337x',
                'description' => '1337X is a torrent website that gives access to digital files for free and can be downloaded with the use of torrent software. It has a collection of digital files such as movies, tv-series, software, music, and ebooks which are all on different platforms for easy access. All of these can be downloaded for free and can be very beneficial for people who cannot buy licensed and original digital files, the only thing the user needs is internet connectivity and he/she can download all the digital contents he/she wants to acquire. But perhaps the most users of this torrent are students because they can download ebooks for free which could help them in studying their lessons. The files are all safe and free from virus so downloading is protected and secured for its loyal users, currently the most popular downloads are movies, and tv series that are in high definition visuals.',
                'logo' => asset('img/logo/1337x.png'),
                'link_1' => 'https://www.1337x.tw/',
                'platforms' => 'web',
                'publisher_slug' => '',
                'entity_type' => 'software',
                "tags" => ["torrent"]
            ],
            [
                'title' => 'Demonoid',
                'slug' => 'demonoid',
                'description' => 'Demonoid is a filesharing website that indexes torrents. It was created in 2013 by Deimos who accidentally died in 2018. The website was then relaunched by his employees in 2019.  Demonoid is one of the largest torrent sites in the world. It indexes thousands of books, movies, music, video games that are uploaded by users all over the world. Using the search function you can search for literally any digital media in existence. After searching for a keyword you can sort your results by file size, seeds, and leechers.  The number of seeders indicates how many people are helping upload the file after downloading it, and leechers are the number of people who are downloading the file from the available seeders. The more seeders a file has, the faster that the file will download to your computer.  You will need a BitTorrent client such as uTorrent to download these files.',
                'logo' => asset('img/logo/demonoid.png'),
                'link_1' => 'https://www.demonoid.is/',
                'platforms' => 'web',
                'publisher_slug' => '',
                'entity_type' => 'software',
                "tags" => ["torrent"]
            ],
            [
                'title' => 'TorrentRover',
                'slug' => 'torrentrover',
                'description' => 'TorrentRover is a torrent application that can be used to download torrent files from a torrent website at a faster pace due to its quick network connectivity and seeds are easier to find for the torrent application. It was developed by Rainberry incorporated along with other torrent applications, it can be used to download any digital media found on torrent websites such as movies, tv-series, software, audio, and ebooks. The only thing the user needs is a stable internet connection, it can be used both on a laptop and smartphone making it very flexible to use. The best feature it could give is that it is entirely free to download and it is very stable to use, unlike other torrent applications that crash due to heavy data usage and data management. Users of these torrent applications are usually people who cannot afford to buy legitimate and original digital content that usually costs a lot.',
                'logo' => asset('img/logo/torrentrover.png'),
                'link_1' => 'https://www.torrentrover.com',
                'platforms' => 'web',
                'publisher_slug' => '',
                'entity_type' => 'software',
                "tags" => ["torrent"]
            ],
            [
                'title' => 'TorrentRover',
                'slug' => 'torrentrover',
                'description' => 'TorrentRover is a torrent application that can be used to download torrent files from a torrent website at a faster pace due to its quick network connectivity and seeds are easier to find for the torrent application. It was developed by Rainberry incorporated along with other torrent applications, it can be used to download any digital media found on torrent websites such as movies, tv-series, software, audio, and ebooks. The only thing the user needs is a stable internet connection, it can be used both on a laptop and smartphone making it very flexible to use. The best feature it could give is that it is entirely free to download and it is very stable to use, unlike other torrent applications that crash due to heavy data usage and data management. Users of these torrent applications are usually people who cannot afford to buy legitimate and original digital content that usually costs a lot.',
                'logo' => asset('img/logo/torrentrover.png'),
                'link_1' => 'https://www.torrentrover.com',
                'platforms' => 'web',
                'publisher_slug' => '',
                'entity_type' => 'software',
                "tags" => ["torrent"]
            ],
            [
                'title' => 'ExtraTorrent',
                'slug' => 'extratorrent',
                'description' => 'Extra Torrent is considered to be the largest digital content index when it comes to torrent files, it was founded in 200 by a software administrator who is only known for his alias as SaM. It was considered to be the largest web torrent when it comes to digital content and the one that started the torrent downloading mania that users still do today. They were first used as a downloading tool for audio files for MP3 players and iPods making them a renowned free downloading website for music lovers. But in May 2017 they have completely shut down the entire operation of the torrent website for unknown reasons wiping all data about the existence of Extratorrent which had sadden its users since it was considered to be the go through website torrent for downloading digital content for free and the only thing the user needs is a reliable internet connection.',
                'logo' => asset('img/logo/extratorrent.png'),
                'link_1' => 'http://extratorrent.cc/',
                'platforms' => 'web',
                'publisher_slug' => '',
                'entity_type' => 'software',
                "tags" => ["torrent"]
            ],

        ], "torrent-search-engine");
    }

    private
    function seedTrading(): void
    {
        $this->entitySeederLoop([
            [
                'title' => 'Trading 212',
                'short_description' => 'A popular commission free broker for stocks, crypto, forex and more.',
                'description' => 'Trading 212 is a platform for online commission-free trading available for various investors. It was launched in 2004 and is currently based in the UK. You can easily trade forex, and stocks in just one motion.   In history, Trading 212 is the first firm to offer free commission in stock trading. With this, millions of traders were able to access the market at just a low cost.   It has a mobile application with more than fifteen million downloads. It has a variety of accounts you can choose from. First is CFO (Contract For Difference) account. This account will allow you to trade among major markets for over 2500 instruments. While Invest and USA accounts give you access to over 10,000 stocks and cryptocurrency exchange traded funds (ETF) in a blink of an eye.   Also, you have added security in Trading 212 as it is being regulated by United Kingdom’s Financial Conduct Authority.',
                'logo' => asset('img/logo/trading-212.png'),
                'slug' => 'trading212',
                'link_1' => 'https://trading212.com/',
                'platforms' => 'web,android,ios',
                'image_1' => asset("img/featured/trading212.webp"),
                'video_1' => "",
                'publisher_slug' => 'trading-212',
                'entity_type' => 'software',
                "tags" => ["trading", "cfds", "stocks", "shares", "funds", "investing", "forex", "crypto trading"]
            ],
            [
                'title' => 'Robinhood',
                'short_description' => 'US-based mobile trading app that offers stocks, ETFs, options and crypto trading.',
                'description' => 'The Robinhood app is going to change many views on investing. The online trading tool is already being employed in many ways. Robinhood can make it easier for people to invest, thanks to the incredible variety of online tools. Trade on the go, using a smartphone to activate the app when it is needed. The Robinhood app has been widely used by people so far. They have years of experience now thanks to the smart app too.  The best step should be reading many of the new reviews. The critics have watched Robinhood develop in to a workable app. The smart phone app can be started at any place in the world. Trade with a greater amount of confidence thanks to the app. The online trading tools have surpassed expectations in several new ways. The Robinhood app is going to be a leader for the novice traders of the world.',
                'logo' => asset('img/logo/50x50/robinhood_50x50.png'),
                'slug' => 'robinhood',
                'link_1' => 'https://robinhood.com/',
                'platforms' => 'android,ios',
                'image_1' => "https://thetechportal.com/wp-content/uploads/2020/03/robinhood-the-tech-portal.png",
                'video_1' => "",
                'publisher_slug' => 'robinhood',
                'entity_type' => 'software',
                "tags" => ["trading", "stocks", "shares", "forex", "crypto trading"]
            ],
            [
                'title' => 'EToro',
                'short_description' => 'Popular ""social trading"" platform. Offers multiple assest and user-friendly interface.',
                'description' => 'eToro is a multi-asset and social trading brokerage company owned by an Israeli that is focused on offering copy and financial trading services like crypto and forex.   The company has physical offices in Australia, the United States, the United Kingdom, and Cyrus. Its headquarters are in Tel Aviv-Yafo, Limassol, London. Also, the company was founded by David Ring, Yoni Assia, and Ronen Assia.   Currently, it is estimated that eToro has about 1200 employees who run its day-to-day programs. Further, it was founded in January 2007.  Currently, eToro is a very established company with millions of users using the application, reliability, and trustworthiness are not to be doubted. This is a platform that you can trade with full confidence.   Creating an account with eToro is absolutely free. You won’t be charged any ticking or management fees and investing in stocks does not come with commission charges.   For withdrawal, you’ll have to incur a $5 fee, plus FX rates are applied to non-USD withdrawals and deposits.',
                'logo' => asset('img/logo/50x50/etoro_50x50.png'),
                'slug' => 'etoro',
                'link_1' => 'https://etoro.com',
                'platforms' => 'web,android,ios',
                'image_1' => "https://www.etoro.com/wp-content/themes/etoro/assets/images/templates/trading_platform/sec-8-img.png",
                'video_1' => "",
                'publisher_slug' => 'etoro',
                'entity_type' => 'software',
                "tags" => ["trading", "stocks", "shares", "forex", "crypto trading", "copy-trading"]
            ],
            [
                'title' => 'IG',
                'short_description' => 'A world-leading provider of Forex, spreadbetting, CFDs and share-dealing.',
                'description' => 'IG is a world leader in online trading. And have provide their clients access to over 10000+ markets. They were founded in 1974, and are based in London. Assets on offer range from cryptocurrencies, to Forex, to commodities and more.',
                'logo' => asset('img/logo/ig.jpg'),
                'slug' => 'ig',
                'link_1' => 'https://ig.com',
                'platforms' => 'web,android,ios',
                'image_1' => "https://a.c-dn.net/c/content/dam/publicsites/igcom/uk/images/ContentImage/content2/demo-account-pack-shot.png",
                'video_1' => "",
                'publisher_slug' => 'ig',
                'entity_type' => 'software',
                "tags" => ["trading", "cfds", "stocks", "shares", "funds", "investing", "forex", "crypto trading"]
            ]
        ], 'trading');
    }

    private
    function seedVideoMovies(): void
    {
        $this->entitySeederLoop([
            [

                'title' => 'Twitch',
                'slug' => 'twitch',
                'short_description' => 'Twitch is Amazon\'s live streaming service, popular with gamers.',
                'description' => 'Twitch is a live video streaming service that mainly focuses on game streaming. The service was launched on June 6, 2011. Emmett shear, Justin Kan, Kevin Lin, Kyle Vogt, and Michael Seibel are the founders of this superb service. Twitch also broadcasts sports besides offering music and creative content broadcasts. The beauty of the service lies in its “in real life” streams.  Users can broadcast themselves live in various ways. They may stream themselves cooking, playing video games, or doing just about anything they can film using a camera. Due to its huge gaming-based crowd, the service was renamed from Justin TV to Twitch Interactive when Amazon acquired the company in 2014 (for 970 million dollars).  The Twitch site had around 45 million unique viewers in October 2003. Later in February 2014, it was termed the fourth biggest source of Internet traffic in the US. By 2015, the service had over 100 million viewers per month. Due to its interactive nature, Twitch is all set to surpass other video platforms in the coming years.',
                'logo' => asset('/img/logo/twitch.png'),
                'link_1' => 'https://twitch.tv/',
                'platforms' => 'windows,mac,linux,web,android,ios',
                'publisher_slug' => 'amazon',
                'entity_type' => 'software',
                "tags" => ["Video Streaming", "Live Streaming", "Social Network", "Live Broadcasting", "Game Streaming"]
            ],
            [

                'title' => 'Live.me',
                'slug' => 'live-me',
                'description' => 'Live.me is a livestream app that was launched in 2016, and since then it has been downloaded more than 20 millions times. The minimum age for using this app is 13 years.  This app allows its users either to livestream their own videos and gain popularity with it, or just watch other users. We could say it is similar to the well known platform twitch, since in Live.me you can also donate diamonds and coins to other users that can be exchanged for real money. Actually, there is people that make a lot of money from these kind of websites due to their popularity, since many other people is ready to pay for others due to the good quality content they create. You are able to share livestreams of any kind If it is appropiated, so it is possible to find streamers doing a huge variety of activities (videogames, sport, vlogs, etc.)  Therefore, If you are looking for a platform to watch many different kind of livestreams or you would like to become a streamer and make money from it this may be a very good option!',
                'logo' => asset('/img/logo/live.me.png'),
                'link_1' => 'https://live.me/',
                'platforms' => 'windows,mac,linux,web,android,ios',
                'publisher_slug' => 'live-me',
                'entity_type' => 'software',
                "tags" => ["Live Streaming", "Live Broadcasting", "Game Streaming"]
            ],
            [

                'title' => 'YouNow',
                'slug' => 'younow',
                'description' => 'YouNow is an online livestreaming platform founded by Adi Sideman in September 2011. It can be used either from their website or from Android and iOS devices. Its main competitors are Periscope and Meerkat.  This software allows users to publish their own livestreams as well as interact with other streamers. Most of the users of this platform are kids from the U.S, Germany and U.K, and as YouNow states, its main goal is to create an interactive plafrom where every person has the freedom to express their feelings and share content. Streamers of this website mainly create content of subjets such as music, food, beauty and fashion. As an user, you are able to explore different streamings, cast together livestreams with other streamers, chat with users during livestreams, and donate to other content creators.  From my point of view YouNow is a good platform and way of leisure for young people, but it is widely known that in this kind of platforms there are cyberbullying cases and therefore parents should know the risks of it. However, YouNow gives the choice to its users to block others, easily solving that problem.',
                'logo' => asset('/img/logo/younow.png'),
                'link_1' => 'https://younow.com/',
                'platforms' => 'windows,mac,linux,web,android,ios',
                'publisher_slug' => 'younow',
                'entity_type' => 'software',
                "tags" => ["Live Streaming", "Live Broadcasting", "Game Streaming"]
            ],
            [

                'title' => 'YouTube',
                'slug' => 'youtube',
                'short_description' => 'YouTube is the world\'s most popular video hosting, streaming, and video sharing platform. By Google.',
                'description' => 'YouTube was created in 2005 by three former employees of PayPal. It is a video-sharing website where users can upload, view, and share videos. In 2006, Google purchased YouTube for $1.65 billion. At the time, it was the largest purchase Google had ever made.  Today, YouTube is one of the most popular websites on the internet. It has over a billion active users and attracts over 122 million visitors per day.  YouTube is different from other video-sharing websites because it allows its users to upload videos of any length. This makes it a great platform for businesses to share their product demonstrations, tutorials, and marketing videos.  In addition to being a popular video-hosting website, YouTube is also a powerful marketing tool. Businesses can use it to reach a large audience and generate leads or sales. Today, the platform is also used by vloggers, gamers, and artists to build a following and engage with their fans.',
                'logo' => asset('/img/logo/youtube.png'),
                'link_1' => 'https://youtube.com',
                'platforms' => 'windows,mac,linux,android,ios,web',
                'publisher_slug' => 'google',
                'entity_type' => 'software',
                "tags" => ["Video Streaming", "Video Hosting", "Live Streaming", "Social Network", "Live Broadcasting", "Game Streaming", "Music Streaming"]
            ],
            [

                'title' => 'DLive',
                'slug' => 'dlive',
                'short_description' => 'DLive is a blockchain-based video streaming platform.',
                'description' => 'DLive is a well-known American video live broadcasting platform that was established back in 2017. In 2019, BitTorrent acquired the streaming service. The site is not strict on content in terms of content guidelines, as such, the platform has become very popular compared to Twitch and YouTube are usually very strict among conspiracy theorists, neo-Nazis, white nationalists, and many other extremists. Aside from that, the site is used by gamers as well as a great alternative to a platform like Twitch. We must point out that twitch leverage a blockchain system for its donation and servers\' system. Originally, it operated using the reputable Steemit blockchain, before it could switch to the also known Lino network after it relaunch back in Sept 2018, and even become TRON network when it was bought by BitTorrent. The founders of the site are Cole Chen and Charles Wayn who undertook their studies at a university in Berkeley.',
                'logo' => asset('/img/logo/dlive.png'),
                'link_1' => '//dlive.com',
                'platforms' => 'web',
                'publisher_slug' => 'dlive',
                'entity_type' => 'software',
                "tags" => ["Video Streaming", "Blockchain", "Live Streaming", "Game Streaming", "Live Broadcasting"]
            ],
            [

                'title' => 'Netflix',
                'slug' => 'netflix',
                'short_description' => 'The most excellent way to watch television is to stream it online.',
                'description' => 'The most excellent way to watch television is to stream it online. Whatever you choose to watch, Netflix is the most incredible option for streaming entertainment. It has a wide range of well-known network shows and more original series, films, documentaries, and specials than any of its many rivals. It doesn\'t matter that there aren\'t as many people signing up for the world\'s first big streaming service. We still love it because it has a massive library of new and updated content and is easy to use on different devices. As of 2021, Netflix won 44 Emmy Awards, which is more than the two media companies put together.  Depending on the plan you choose, between $10 and $20 a month. There was a lot of excitement when it raised its prices recently. Netflix is now closer to HBO Max in price than before the price change. On the other hand, the more costly plan allows you to view up to four screens at once and create multiple user profiles, so you could theoretically divide the cost with your pals. With so many series and movies to pick from, Netflix provides the most value for your money.  More than 190 nations now have Netflix customers, totaling more than 200 million. During the pandemic, Netflix saw a significant rise in the number of people who used the service. The Netflix app is compatible with both Android and iOS devices.  Every one of these devices is supported as well as Roku (as well as Apple TV) and Chromecast (as well as Xbox One, Xbox Series X and S), PlayStation 4 (as well as PlayStation 5).  Netflix may have been the first streaming service out there, but it hasn\'t lost its momentum because it\'s been making more and more original shows and movies. Many of these shows and films have been critically acclaimed and nominated for major awards and awards.  For example, programs like Squid Game and Ozark, two Netflix originals, are currently top television shows. Unfortunately, other streaming platforms don\'t have as many original shows as Netflix. For example, it also has Marvel\'s older superhero TV shows, like Daredevil, Jessica Jones, and Luke Cage. But new Marvel shows like WandaVision and Loki only show up on Disney Plus, which costs extra.  Netflix has a lot of original shows that aren\'t TV shows. They have comedies, dramas, foreign films and shows, documentary series, stand-up comedy specials, reality dating, competition shows, and more. Unfortunately, only a few of them are massive hits. However, there\'s enough to look into exciting shows that might not have been on traditional network TV.  There aren\'t many shows on Netflix that aren\'t full seasons at a time. If you don\'t have cable or another service like Hulu, you\'ll have to wait for a few months.  Using Netflix now is second nature to me because I signed up for the service back in 2007. You can use it even if you don\'t know-how: It\'s easy to start the app. If you have a profile, you can tap on it. You\'ll see a page called "Home." Keep Watching, Trending Picks for You, and other categories based on shows you\'ve already watched will show up. My favorites are Critically-acclaimed TV comedies and TV comedies about suburban dysfunction, for example.  Netflix\'s design encourages you to keep scrolling. There are shows and movies in those categories to keep scrolling. Create a watch list to help you avoid this. The library is so extensive that it\'s easy to spend more time looking through shows than watching them, so be careful.  The Netflix app works the same on all kinds of devices. My home page on the web browser is almost the same as my Apple TV, Roku, and Amazon Fire TV Stick, both in content and design. Smaller iPhone and Android phone screens make it look a little more compact, but it still looks the same and has an easy-to-find "Downloads" tab so you can save the content so you can watch it later on your phone or tablet.  With a Standard or Premium subscription, you may create several profiles for different individuals and receive tailored suggestions for each one. It\'s not only for general streaming.  If you sign up for the Premium plan, you can watch some shows and movies in 4K Ultra HD on 4K TVs if you want. Need a steady internet speed of at least 25 megabits per second, and set the streaming quality to either Auto or High to watch.  Many of Netflix\'s 4K shows and movies can also be watched in HDR. Netflix has more 4K content than almost any other streaming service out there. According to CNET\'s tests, the high dynamic range has even better contrast and color than 4K. The difference is even more noticeable on big, high-end TVs. Generic HDR (also known as HDR-10) and Dolby Vision are the two main HDR formats that Netflix can play. As a rule, Netflix will play content (if it\'s available) in Dolby Vision when it\'s on a device that can handle that format.  Standard-definition video consumes about 1GB of bandwidth every hour, while 4K video can take up to 7GB. Netflix says that downloading and streaming using the same amount of data. If you don\'t want Netflix to eat up all of your data, you can follow the steps Netflix has on its website to change how much data it takes.  All Netflix subscribers can download TV shows and movies from the Netflix app for offline viewing on their phones and tablets.  Netflix is still my favorite way to watch movies and TV shows. It has a lot of old and new movies and TV shows, a lot of high-quality original programs, and a simple way to find what you want.  You should give it a try if you want to watch something new.',
                'logo' => asset('/img/logo/netflix.png'),
                'link_1' => '//netflix.com',
                'platforms' => 'web',
                'publisher_slug' => 'netflix',
                'entity_type' => 'software',
                "tags" => ["Video Streaming"]
            ],
            [

                'title' => 'Vimeo',
                'slug' => 'vimeo',
                'short_description' => 'The most excellent way to watch television is to stream it online.',
                'description' => 'Vimeo is a popular video-sharing site created by Jake Lodwick and Zach Klein in 2004. It allows you to upload uncompressed, high-quality video content making it a great tool for film and documentary makers.  You can upload a few videos for free with a Vimeo Basic account, but the best features of the site require a premium account starting at $7 per month. A premium account unlocks a ton of great features such as the option to set your own price for viewers to view your content, and those viewers can download the video in full resolution directly from the website.  A huge advantage that it has over other video-sharing platforms is that it also provides a wide array of customization options when embedding content onto other websites and apps. When you embed your video onto another website, you can set an option to have the viewer enter a password or submit their email in order to view the content, for example.  Vimeo acquired Livestream.com in 2017 which now allows you to stream high-quality content to live viewers all over the world. It even supports 360and virtual reality content which makes this the premier video platform for any creator who is on the cutting edge of content creation.',
                'logo' => asset('/img/logo/vimeo.png'),
                'link_1' => '//vimeo.com',
                'platforms' => 'web',
                'publisher_slug' => 'vimeo',
                'entity_type' => 'software',
                "tags" => ["Video Streaming"]
            ],
        ], 'videos-movies');

        $this->entitySeederLoop([
            [
                'title' => 'Animoto',
                'slug' => 'animoto',
                'description' => 'Animoto was founded in 2006 by Tom Clifton, Brad Jefferson, Jason Hsiao, and Steve Clifton. It is a cloud-based video creation platform that allows users to create videos from photos, music, and text. What separates Animoto from other video creation platforms is its ability to create videos quickly and easily.  At that time, it was one of the first video creation platforms to offer cloud-based video creation. Using Animoto, users could create video slideshows in minutes by adding photos, music, and text. It also offered a wide range of templates that made it easy for users to get started quickly.  With its continuously growing library of templates and music, Animoto now offers users the ability to create videos in various styles. It also has a range of features, such as the ability to add text overlays, change the speed of the video, and add logos or watermarks. Animoto is popular among individuals and businesses who are looking to create quick and easy videos.  Create quick informative videos, short infomercials, or social media clips with Animoto. It comes in different subscription plans, with a limited-time free trial.',
                'logo' => asset('img/logo/animoto.png'),
                'link_1' => 'https://animoto.com',
                'platforms' => 'windows,mac,linux,web,android,ios',
                'publisher_slug' => '',
                'entity_type' => 'software',
                "tags" => ["video editor", "video maker", "slideshow maker", "animation"]
            ],
            [
                'title' => 'Vyond',
                'slug' => 'vyond',
                'description' => 'Vyond was created in 2007 by Alvin Hung for the purpose of creating animated videos for his wife. What used to be a simple web-based application for producing shorts, has come a long way to producing creative explainer business often used for marketing and training videos.  What makes Vyond unique is that it allows users to create professional-quality animated videos in minutes - without any prior animation experience or software knowledge. It comes with a wide range of templates, characters, and scenes that can be used to create your video. It comes with a monthly subscription plan and offers a free trial.  Users can also use their own voice and music tracks, or use the provided voice-over and music library. Now known as Vyond, it\'s a popular choice for creating animated explainer videos, marketing videos, and even video resumes. It has continuously changed the way videos are created and is now used by over 200,000 businesses.',
                'logo' => asset('img/logo/vyond.svg'),
                'link_1' => 'https://animoto.com',
                'platforms' => 'web',
                'publisher_slug' => '',
                'entity_type' => 'software',
                "tags" => ["video editor", "video maker", "animation"]
            ],
        ], 'video-editor');
    }

    private
    function seedVPN(): void
    {
        $this->entitySeederLoop(
            [

                [
                    'slug' => 'nordvpn',
                    'title' => 'NordVPN',
                    'short_description' => 'The NordVPN service allows you to connect to 2380+ servers in 56+ countries.',
                    'description' => 'Nord VPN was created in 2012 by a team of developers. It is a virtual private network (VPN) that allows users to connect to the internet through servers located all over the world. Nord VPN is one of the most popular VPNs on the market, and for good reason.  What makes Nord VPN unique is its focus on security. It\'s one of the few VPNs that offer military-grade encryption, which makes it perfect for businesses and individuals who are concerned about their online privacy.  Nord VPN is also one of the fastest VPNs on the market, making it perfect for streaming videos and downloading files. It encrypts the user\'s data and masks their IP address, making it difficult for anyone to track their online activity.  Nord VPN can be used on a variety of devices, including computers, smartphones, and tablets. It has multiple pricing plans and can be installed on multiple devices.',
                    'logo' => asset('/img/logo/nordvpn.png'),
                    'link_1' => '//https://nordvpn.sjv.io/jW55WZ',
                    'platforms' => 'windows,mac,android,ios',
                    'image_1' => asset("img/featured/nordvpn.png"),
                    'video_1' => "",
                    'publisher_slug' => 'nordvpn',
                    'entity_type' => 'software',
                    'tags' => ['VPN']
                ],
                [
                    'slug' => 'express-vpn',
                    'title' => 'Express VPN',
                    'short_description' => 'ExpressVPN hides your IP address and encrypts your network data so no one can see what you’re doing. Become anonymous in seconds. ',
                    'description' => 'Express VPN is one of the most well-known and popular VPN providers on the market today. What sets Express VPN apart from its competition is its innovative and proprietary Lightway VPN protocol. Lightway uses the wolfSSL, which has an extensive cryptography library. Lightway helps maintain your security by using dynamic encryption keys that are purged and regenerated regularly.  A VPN is a virtual private network. When using a VPN a secure and encrypted link is established between your computer or device and the websites that you visit. This means that anyone trying to look at your online activity will not be able to do so, including your internet service provider.  If you have used public wifi in places like restaurants, hotels, airports, or at work then a VPN might be a great option for you. In addition, VPNs can be a great way to change regions when using streaming services in order to access additional content or to get a discount when ordering airfare.',
                    'logo' => asset('/img/logo/express vpn.png'),
                    'link_1' => 'https://expressvpn.com/',
                    'platforms' => 'windows,mac,android,ios,web',
                    'image_1' => asset('img/featured/express vpn.png'),
                    'video_1' => "",
                    'publisher_slug' => 'express-vpn',
                    'entity_type' => 'software',
                    'tags' => ['VPN']
                ],
                [
                    'slug' => 'surf-shark',
                    'title' => 'Surf Shark VPN',
                    'short_description' => 'An excellent, cheap VPN.',
                    'description' => 'Surfshark is a reputable Virtual Private Network company that is situated in the British Virgin Islands. With this VPN, users can access this server around the globe as a way of hiding their browsing work with the use of end-to-end encryption.   The goodness with the service is that it comes with apps that suit the Amazon Fire TV stick, macOS, Windows, Android, iPad, and iPhone. You can be sure that your browsing will be hidden and no one will steal your data in any way.   Since you change your IP, your privacy is increased and no one can track you because you can switch from one IP address to another. Better still, you can travel securely because you’ll not have any fear when using a network connection that is not protected.   The advantage of this service is the fact that there is no logs policy, offers high-speed content delivery, 24/7 customer support, advanced security features, and can support unlimited devices.',
                    'logo' => asset('/img/logo/surfshark.png'),
                    'link_1' => 'https://surfshark.com/',
                    'platforms' => 'windows,mac,android,ios,web',
                    'image_1' => asset('img/featured/surfshark.png'),
                    'video_1' => "",
                    'publisher_slug' => 'surf-shark',
                    'entity_type' => 'software',
                    'tags' => ['VPN']
                ],
                [
                    'slug' => 'proton-vpn',
                    'title' => 'Proton VPN',
                    'short_description' => 'One of the most improved VPN services on the market.',
                    'description' => 'ProtonVPN is a VPN service that provides a secure, private and anonymous way to unblock blocked content, surf anonymously, and get access to all your favorite websites from anywhere in the world. It is a public network that allows you to connect to the Internet from your home computer or laptop and it allows you to access your favorite websites and apps safely, privately and securely.  ProtonVPN has been around for years now, with over 40 million users in more than 100 countries worldwide. The VPN app is free for mobile phones and tablets, with no limitations on the number of devices you can connect simultaneously.  ProtonVPN makes it simple for people who are already familiar with the basics of networking and VPN usage to learn about the technology without having to spend any money on packet sharing internet services or VPN services themselves.  VPNs are the rockstars of the Internet. They seek to bypass the restrictions on your personal and financial data. They shield you from hackers and other online intruders while allowing you to surf safely.',
                    'logo' => asset('/img/logo/protonvpn.jpg'),
                    'link_1' => 'https://surfshark.com/',
                    'platforms' => 'windows,mac,android,ios,web',
                    'image_1' => asset('img/featured/proton-vpn.png'),
                    'video_1' => "",
                    'publisher_slug' => 'surf-shark',
                    'entity_type' => 'software',
                    'tags' => ['VPN']
                ],
                [
                    'slug' => 'cyberghost',
                    'title' => 'CyberGhost',
                    'short_description' => 'A feature packed VPN with lots of configurability.',
                    'description' => 'CyberGhost is a VPN service that allows users to bypass internet censorship and provide high-speed internet connections to people in countries where internet censorship is severe. CyberGhost also helps protect privacy.  CyberGhost isn\'t just a VPN service — it\'s a so-called “decentralized network.” This means that you aren\'t connected via a single IP address but rather independent networks with their own protocols and other parameters determined by the user. Through this network, any user can connect to any other user using any protocol and any kind of encryption tool .  This provides an Internet connection that almost doesn\'t exist: In some countries, no Internet connection exists. In others, Internet connections are extremely slow or inoperable for many hours of the day. There is no longer anything like an Internet connection for those who live in these regions and thus no way to reach people outside their country.  Cyberghost offers unrivaled security and privacy, which are essential for anyone who relies on the Internet for work or personal communication outside his country .',
                    'logo' => asset('/img/logo/cyberghost-vpn.png'),
                    'link_1' => 'https://cyberghost.com/',
                    'platforms' => 'windows,mac,android,ios,web',
                    'image_1' => asset('img/featured/cyberghost.jpg'),
                    'video_1' => "",
                    'publisher_slug' => 'cyberghost',
                    'entity_type' => 'software',
                    'tags' => ['VPN']
                ],
                [
                    'title' => 'OpenVPN',
                    'slug' => 'openvpn',
                    'description' => 'OpenVPN is a system that creates secure point to point connections for a safe web-browsing experience for the user since connecting to the internet might not be as private as everyone thinks because someone might be snooping around in the connections deliberately stealing sensitive data and information to the user which is why using OpenVPN is very important. It was developed by OpenVPN Incorporated and was released in May 2001 over 20 years ago making it one of the most trusted VPNs for internet savvy users. But as a precaution, everyone must have a VPN installed on their desktop PC and Laptops as protection when using the internet, since it protects the user from hackers who could steal your data while browsing the internet. Its free and can be easily installed just go to its official website and download the application, it has friendly user interface and they guarantee that you will be secured while browsing the web.',
                    'logo' => asset('img/logo/openvpn.png'),
                    'link_1' => '//openvpn.com',
                    'platforms' => 'windows,mac,linux,web,android,ios',
                    'publisher_slug' => 'openvpn',
                    'entity_type' => 'software',
                    "tags" => ["vpn", "vpn client"]
                ]
            ], "vpn"
        );
    }

    private
    function seedWebcamSoftware(): void
    {
        $this->entitySeederLoop([
            [
                'title' => 'ManyCam',
                'slug' => 'manycam',
                'description' => 'ManyCam is an application that allows people to use multiple videos chat and stream at once with a single webcam. It was developed by Viscom Media Inc and its initial release was on March 22nd, 2006 with a stable release in 2018. It was written in C++ for Windows and MacOS operating systems and is available in 9 languages.  This platform enhances the way you use live video. It has an "invite guest" (BETA) feature that allows multiple users to talk at once. With a virtual background feature, you can blur out your background or can use a green screen feature. It also has a whiteboard to draw and make your presentation more exciting. You can easily save your files while streaming live and use ManyCam virtual webcam to stream live on Facebook and Youtube. You can create up to 24 video sources or create a video playlist. It also has an NDI source and Layers with rounded corner features to make your video interesting.  They have multiple plans for individual or business enterprises with a 30-day money-back guarantee. Anyone who wants to have a better experience with a webcam should use Manycam but you must be at least 18 years old to use this platform.',
                'logo' => asset('img/logo/manycam.png'),
                'link_1' => 'https://manycam.com/',
                'platforms' => 'windows',
                'publisher_slug' => '',
                'entity_type' => 'software',
                "tags" => ["webcam software"]
            ],
            [
                'title' => 'YouCam',
                'slug' => 'youcam',
                'description' => 'An excellent platform to enhance your appearance on the webcam, this app equips itself with a pack of photo-retouching tools. Everything is effortlessly accessible through its straightforward yet sophisticated UI design',
                'logo' => asset('img/logo/youcam.png'),
                "image_1" => "https://www.cyberlink.com/prog/product/html/32477/9/img/ycm_Look_Sharp.jpg",
                'link_1' => 'https://www.cyberlink.com/products/youcam/features_en_GB.html?r=1',
                'platforms' => 'windows',
                'publisher_slug' => 'cyberlink',
                'entity_type' => 'software',
                "tags" => ["webcam software"]
            ]
        ], "webcam-software");
    }

    private
    function seedWebHosting(): void
    {
        $this->entitySeederLoop([
            [
                'title' => 'Hostgator',
                'slug' => 'hostgator',
                'description' => 'One of the most popular hosting companies up to date, Hostgator, once started as a small startup in 2002. Brent Oxley, a student at the time, created the company in his dorm room at Florida Atlantic University.  Hostgator is now one of the largest hosting companies in the world, with over eight million domains hosted on its servers. It offers a variety of services, such as shared hosting, WordPress hosting, VPS hosting, and dedicated servers.  What makes Hostgator popular among businesses is its affordability (it has some of the most competitive prices in the hosting industry) and its wide range of features. Hostgator also offers 24/hour customer support, which is available through phone, email, and chat. It also has a wide variety of tutorials and articles that can help users get started with their website or blog.  Hostgator is perfect for individuals, businesses, bloggers,s, and entrepreneurs looking for an affordable, reliable, and feature-rich hosting company. It offers a variety of subscription plans, with a free domain upon signing up for your first hosting plan.',
                'logo' => asset('img/logo/hostgator.png'),
                'link_1' => '//hostgator.com',
                'platforms' => 'web',
                'publisher_slug' => 'hostgator',
                'entity_type' => 'software',
                "tags" => ["web hosting", "domain registrar"]
            ],
            [
                'title' => 'GoDaddy',
                'slug' => 'godaddy',
                'description' => 'GoDaddy is a web hosting and domain registration company that was founded in 1997 by Bob Parsons. It offers users the ability to register a domain name, create a website, and host their website online. Its simple and easy-to-use interface makes it popular among businesses and individuals who are looking to get started with a website.  What makes GoDaddy unique is that it offers a wide range of features for businesses of all sizes. It has plans that start at $0.99/on the first month and offer a wide variety of features, such as unlimited storage and bandwidth, email accounts, and more. Additional features that are available for paid subscription plans include a free SSL certificate, daily backups, and malware removal.  GoDaddy is also perfect for businesses that are looking to get started online. It offers a wide range of plans that are easy to use and affordable. In addition, it has a team of experts who can help users get started and are available 24/hours a day, 7 days a week.',
                'logo' => asset('img/logo/godaddy.png'),
                'link_1' => '//godaddy.com',
                'platforms' => 'web',
                'publisher_slug' => 'godaddy',
                'entity_type' => 'software',
                "tags" => ["web hosting", "domain registrar"]
            ],
            [
                'title' => 'Namecheap',
                'slug' => 'namecheap',
                'description' => 'NameCheap was founded in 2000 by Richard Kirkendall. It is a domain name registrar and web hosting company that is headquartered in Los Angeles, California. The company has over two million customers and provides a wide range of services, including domain name registration, web hosting, email addresses, SSL certificates, and more.  NameCheap is known for its competitive prices and excellent customer service. It is one of the few domain name registrars that offer a free whois privacy protection with each domain name registration, something that\'s hard to come by to these days.  It also has a user-friendly interface that makes it easy to register and manage domains. The company is also transparent about its pricing, which makes it a popular choice among businesses and individuals.  As a domain name registration and web hosting company, NameCheap has become one of the most popular providers in the world. It has a large customer base and provides a wide range of services that are affordable and easy to use.',
                'logo' => asset('img/logo/namecheap.png'),
                'link_1' => '//namecheap.com',
                'platforms' => 'web',
                'publisher_slug' => 'namecheap',
                'entity_type' => 'software',
                "tags" => ["web hosting", "domain registrar"]
            ],
            [
                'title' => 'Google Domains',
                'slug' => 'google-domains',
                'description' => 'Google Domains was created in 2014 as a way for businesses to purchase and manage their domain names. It is a part of Google\'s suite of online services, which also includes Gmail, Google Drive, and Google Maps.  Google Domains allows users the ability to manage a wide range of domain names from one central location. It also integrates with other Google services, making it easy for businesses to create and manage their online presence. Over the years, it has become one of the most popular domain name management platforms on the market.  One of the best features of Google Domains is its pricing. It offers some of the cheapest rates on the market, starting at $12/year. It also integrates with other Google services, making it a great value for businesses that are looking to manage their online presence.  Businesses managing multiple domain names will find Google Domains to be an invaluable resource.',
                'logo' => asset('img/logo/google-domains.png'),
                'link_1' => '//domains.google.com',
                'platforms' => 'web',
                'publisher_slug' => 'google',
                'entity_type' => 'software',
                "tags" => ["domain registrar"]
            ],
            [
                'title' => 'WP Engine',
                'slug' => 'wp-engine',
                'description' => 'WP Engine is a web hosting company that specializes in WordPress hosting. They offer a suite of tools and services to make it easy for users to set up and manage their WordPress site. WP Engine is the only host endorsed by WordPress.org.  The company was founded in 2010 by Jason Cohen, who is also the founder of Smart Bear Software. WP Engine has been featured in Forbes, The Wall Street Journal, and other publications for its innovative products and exceptional customer service.  WP Engine is a great choice for WordPress site owners who want the peace of mind that comes with knowing their site is being hosted on a platform that is endorsed by WordPress.org. Perfect for small-scale businesses to full-time bloggers and larger companies, WP Engine allows companies to get started with WordPress without having to worry about the technical details.  Their platform is fast, reliable, and secure. With a 30-day money-back guarantee, WP Engine is a risk-free choice for WordPress site owners.',
                'logo' => asset('img/logo/wp-engine.png'),
                'link_1' => '//wpengine.com',
                'platforms' => 'web',
                'publisher_slug' => 'wpengine',
                'entity_type' => 'software',
                "tags" => ["web hosting", "wordpress hosting"]
            ],
            [
                'title' => 'DigitalOcean',
                'slug' => 'digitalocean',
                'description' => 'DigitalOcean is a cloud computing platform that provides developers with on-demand access to virtual servers. Started in 2011, the company has become one of the most popular choices for developers who want to get their applications off the ground quickly and easily.  The company offers a simple drag-and-drop interface for creating and managing Droplets, which are the individual compute instances running on Digital Ocean\'s infrastructure.  Developers can use Droplets to deploy web applications, create custom software stacks, or run their own computing tasks. Digital Ocean has become a popular choice for developers thanks to its competitive pricing, easy-to-use interface, and wide range of features. The company is also known for its fast and reliable customer support.  DigitalOcean\'s target market consists of web developers and other technical professionals. However, the company\'s services can be used by anyone with an internet-connected device.  With a free account, developers can create one Droplet and get $20 in credits to use for testing and development. Paid plans start at $20/month for a single CPU and 512 MB of memory.',
                'logo' => asset('img/logo/digitalocean.png'),
                'link_1' => 'https://m.do.co/c/d490717f4c75',
                'platforms' => 'web',
                'publisher_slug' => 'digitalocean',
                'entity_type' => 'software',
                "tags" => ["web hosting", "wordpress hosting", "cloud hosting", "vps hosting"]
            ],
            [
                'title' => 'Dreamhost',
                'slug' => 'dreamhost',
                'description' => 'Dreamhost is a web hosting company that was founded in 1997 with the goal of providing affordable and reliable hosting services. It is one of the few web hosts that offer a 97-day money-back guarantee, which gives users plenty of time to decide if their service is right for them.  Dreamhost offers unlimited storage space and bandwidth, as well as a free domain name for the first year. The majority of their plans also include a free SSL certificate that most other hosts charge extra for.  One of the best features of Dreamhost is its user-friendly control panel. This makes it easy for new users to set up their website and start publishing content almost immediately. Dreamhost also offers a wide range of tutorials and support articles that can help users get the most out of their hosting plan.  With various hosting options to choose from, Dreamhost is a great choice for small businesses, bloggers, and anyone else who needs a reliable hosting service at a reasonable cost.',
                'logo' => asset('img/logo/dreamhost.png'),
                'link_1' => 'http://click.dreamhost.com/aff_c?offer_id=8&aff_id=4895',
                'platforms' => 'web',
                'publisher_slug' => 'dreamhost',
                'entity_type' => 'software',
                "tags" => ["web hosting", "wordpress hosting", "cloud hosting", "vps hosting", "domain registrar"]
            ],
            [
                'title' => 'Hostwinds',
                'slug' => 'hostwinds',
                'description' => 'Hostwinds is a website hosting provider that stores the necessary data on a server so that your website can be viewable to the public. It was created in 2015 by Peter Holden who wanted to create an affordable option for the everyday person who wants to start a website.  They have 4 different hosting options to accommodate your needs which are all customizable, and they can prioritize resources for you to make your website run as smoothly as possible. Along with web hosting, they also offer cloud servers, VPS hosting, or a dedicated server in case you need full control over how your website operates.  Hostwinds offers 24/7 customer support that is readily available and reliable. Their servers also have a 99% uptime which means your website will virtually always be online.  Hostwinds plans start at $6.74 per month as of this writing and include hosting for 1 domain, unlimited bandwidth, and unlimited storage.',
                'logo' => asset('img/logo/hostwinds.svg'),
                'link_1' => '',
                'platforms' => 'web',
                'publisher_slug' => 'hostwinds',
                'entity_type' => 'software',
                "tags" => ["web hosting", "cloud hosting", "vps hosting", "domain registrar"]
            ],
            [
                'title' => 'Linode',
                'slug' => 'linode',
                'description' => 'Linode is a company that provides business professionals access to virtual machines. It was founded in 2003 by Christopher Aker who wanted to make virtual Linux systems affordable and easy to use by the public.  Linode has a built-in app designer that makes it easy for you to create web and mobile apps for your business. Minimal coding is required to create beautiful apps that your customers will love to use. All virtual machines include a user-friendly version of Linux if you want to create more advanced applications.  They also offer cloud storage, managed databases, and cloud firewalls. They really take cloud computing to the next level by offering virtual machines that can emulate high memory and CPU clock speeds so that you can run high-performance applications without having to purchase new hardware.  Linode plans start at $0.05 cents per hour for a virtual Linux system with 2 CPUs, 4GB of RAM, and an 80GB SSD.',
                'logo' => asset('img/logo/linode.png'),
                'link_1' => '',
                'platforms' => 'web',
                'publisher_slug' => 'linode',
                'entity_type' => 'software',
                "tags" => ["web hosting", "cloud hosting", "vps hosting", "cloud storage"]
            ],
            [
                'title' => 'Pagely',
                'slug' => 'pagely',
                'description' => 'Pagely is the brainchild of a team of web developers who were frustrated with the limitations of traditional hosting solutions. Co-Founder Joshua Strebel had the idea to create a managed hosting platform that would take care of all the nitty-gritty details for users so they could focus on their business.  In 2006, they set out to create a hosting platform that would allow businesses of all sizes to reap the benefits of scalable WordPress hosting.  Since its inception, Pagely has been at the forefront of WordPress innovation, developing new products and features that have helped make WordPress the leading content management system on the web. Their team of experts is constantly working to ensure that Pagely\'s platform is the most reliable and secure WordPress hosting solution available.  Pagely\'s flagship product is its Managed WordPress Hosting Platform. This platform is designed to provide businesses with everything they need to host a fast, scalable, and secure WordPress website. It includes automatic backups, malware scanning, and removal, 24/7 support, and much more.',
                'logo' => asset('img/logo/pagely.svg'),
                'link_1' => '',
                'platforms' => 'web',
                'publisher_slug' => 'pagely',
                'entity_type' => 'software',
                "tags" => ["web hosting", "wordpress hosting"]
            ],
            [
                'title' => 'Kinsta',
                'slug' => 'kinsta',
                'description' => 'Kinsta is a website hosting platform that offers managed WordPress hosting for developers and entrepreneurs. Kinsta was created in 2013 by Mark Gavalda who set out to create the best WordPress hosting platform in the world.  Kinsta is built on the Google Cloud Platform which allows access to both virtual servers and physical machines to make your website run quickly and smoothly. The Premier Tier Network that it runs on delivers data to users around the world in the most secure way possible. They provide affordable Linux Containers to store website data separately from their main servers which provide an added level of security.  The Kinsta dashboard is designed specifically for WordPress users who want a user-friendly experience that gives complete control over the design of their website. It saves time on repetitive tasks with its ability to update PHP and make edits to multiple WordPress sites simultaneously.  Kinsta starts at $30 per month for 1 WordPress site, 10 GB of storage, and 25,000 website visitors.',
                'logo' => asset('img/logo/kinsta.webp'),
                'link_1' => '',
                'platforms' => 'web',
                'publisher_slug' => 'kinsta',
                'entity_type' => 'software',
                "tags" => ["web hosting", "wordpress hosting"]
            ],
            [
                'title' => 'OVHCloud',
                'slug' => 'ovhcloud',
                'description' => 'OVHcloud is a cloud computing platform that allows developers and entrepreneurs access to high-performance virtual machines. It was created in 1999 by Octave Klaba who initially wanted to build an affordable website hosting platform that was transparent about pricing to its customers.  OVHcloud has built a fiber-optic network that spans the globe to create one of the most reliable and secure cloud computing platforms available today. It\'s a forward-thinking company that uses sustainable energy to power its 33 data centers so that they don\'t have to spend money on air conditioning, and they can in turn provide surplus energy to the community.  OVH uses a hosted private cloud infrastructure powered by VMware to allow business owners to port their existing virtual machines to a faster and more efficient system without making any changes to their business processes. Your employees won\'t have to learn any new skills or processes because it directly transfers all the software and data that they already work with on a daily basis to the new platform.',
                'logo' => asset('img/logo/ovhcloud.jpg'),
                'link_1' => '',
                'platforms' => 'web',
                'publisher_slug' => 'ovhcloud',
                'entity_type' => 'software',
                "tags" => ["web hosting", "cloud hosting"]
            ],
            [
                'title' => 'WebFlow',
                'slug' => 'webflow',
                'description' => 'Webflow is a website builder that allows everyday people to create beautiful websites without having to write any code. It was created in 2013 by Vlad Magdalin, Sergie Magdalin, and Bryant Chou who aimed at making the most user-friendly website builder available.  Webflow is incredibly easy to use. It uses a drag and drop system to design your website by simply dragging objects onto the canvas and editing them to your liking.  The style and CSS properties of each element can be configured using the sliders and menus on the right of the screen. While you don\'t have to actually type any code, there may be a slight learning curve for those who are unfamiliar with how CSS works. You\'ll have to structure your elements in a concise way so that your design will fit all of the elements on screen properly.  Webflow is free to get started with full control of your design, but if you want to have a custom domain or enable e-commerce you\'ll need to sign up for a plan starting at $15 per month.',
                'logo' => asset('img/logo/webflow.png'),
                'link_1' => '',
                'platforms' => 'web',
                'publisher_slug' => 'webflow',
                'entity_type' => 'software',
                "tags" => ["web hosting", "website builder"]
            ],
        ], 'web-hosting');
    }

    private
    function seedWordProcessor()
    {
        $this->entitySeederLoop(
            [
                [
                    'title' => 'Microsoft Word',
                    'slug' => 'microsoft-word',
                    'description' => 'Microsoft\'s native word processing suite.',
                    'logo' => asset('img/logo/microsoft-word.png'),
                    'link_1' => 'https://www.microsoft.com/en-us/microsoft-365/word',
                    'platforms' => 'windows,mac,linux,web,android,ios',
                    'publisher_slug' => '',
                    'entity_type' => 'software',
                    "tags" => ["Word Processor", "Text Editor", "Export to PDF"]
                ],
                [
                    'title' => 'LibreOffice Writer',
                    'slug' => 'libreoffice-writer',
                    'description' => 'LibreOffice is an open code productivity software that was launched in 2010. It was developed by some members of the OpenOffice.org comunity, who thought that users should be have the freedom to execute, copy, study and change the software they distributed for free. It was developed in C++, Python, and Java code languages.  This software is a powerful text proccessing tool, compatible with other softwares such as Microsoft Word and with different operative systems such as Windows, Linux or Mac OS. It can be used as a tool to edit texts from your computer, and If you have never used it you may think it is a copy Microsoft Word, but it has some particular features that Word doesn\'t have. The main difference between Word and LibreOffice is that Microsoft Word is a software that belongs to Microsoft\'s office suite, which means you have to pay for using it, while LibreOffice is a free to use software. Furthermore, LibreOffice allows you to encode a document through GPG protocol, which reduces the risk of unauthorized people getting your information, which is a feature that Word doesn\'t have.  Therefore, If you don\'t want to spend money on a safe and powerful text editor, you should definitely check LibreOffice\'s website, I\'m sure you won\'t be dissapointed.',
                    'logo' => asset('img/logo/libreoffice---writer.png'),
                    'link_1' => 'https://www.libreoffice.org/discover/writer/',
                    'platforms' => 'windows,mac,linux,web,android,ios',
                    'publisher_slug' => '',
                    'entity_type' => 'software',
                    "tags" => ["Word Processor", "Text Editor", "Export to PDF"]
                ],
                [
                    'title' => 'GoodNotes',
                    'slug' => 'goodnotes',
                    'short_description' => 'GoodNotes is a beautiful and powerful PDF annotating and organizing App. It allows you to read, mark up, review, and share your documents.',
                    'description' => 'GoodNotes is a beautiful and powerful PDF annotating and organizing App. It allows you to read, mark up, review, and share your documents. Whether you process business contracts or use annotations on notes and textbooks this software is the ultimate companion for your needs.  It includes optical character recognition technology and handwriting, which will enable you to search for digital notes using various keywords.  All your documents and annotations will be securely stored on all Apple devices. You can protect them with a strong password and log in automatically without filling in any complicated forms.  GoodNotes also allows you to mix handwriting, drawings, and digital text freely on one page and add an unlimited number of notes per document. You can export and print your documents and pass them to other people or import and annotate them even on a Windows PC.  A brand new document manager allows you to review all the files stored in one place. The file manager will help you sort out large notes and decide which ones to delete, share, reorganize or move to iCloud.  GoodNotes has digital highlighters, vector drawings tools with layers support, and more powerful annotation options. You can also make your handwriting look prettier by choosing from 6 different pen styles or erasing it if you made a mistake. The new note editor allows you to type custom text right on the page, and you can also change the text size and color.  This new App has all the PDF annotation tools we\'ve dreamed of: fast and precise Highlighter with unlimited colors, Marker Pen, Squiggly Line tool, Text Stamp, Rectangle Boxes, and Arrows. There are also Emoji Stickers which you can use for a quick note or highlight.  GoodNotes has many features to make your work easier: you can use many different options, adjust the vertical and horizontal spacing between notes per page, manage text alignment, background colors, and zoom level. What\'s most important is that GoodNotes lets you get rid of paper completely and work even when there\'s no Internet connection.  The program is compatible with all Apple products: iPhone, iPad, and macOS computers. Just download it once and always access your PDF documents on any device you own.  GoodNotes has a user-friendly interface. Its pricing ranges from $7.99 monthly to $39.99 annually, and you can try it for free as well: download the App and go enjoy 3 days of these features completely free of charge.  Some so many people can benefit from this software, and they include:   Lawyers or people who deal with many legal documents daily. GoodNotes will help them review, mark up and organize papers without buying additional equipment.  Students can use GoodNotes\' built-in optical character recognition to search for handwritten annotations using keywords. This will save their time spent on research and studying.  Salespeople can use GoodNotes\' notetaking capabilities to decrease notetaking time and process their sales faster.  Business owners can decrease the number of meetings by delegating tasks online with Goodnotes\' digital signature feature.  Anyone who wants to go paperless or has a hard time keeping track of important documents.  GoodNotes is the best companion for any Apple device to take notes, annotate documents and create amazing papers. This note taking app will enable you to save your time spent on research and studying',
                    'logo' => asset('img/logo/goodnotes.png'),
                    "image_1" => asset('img/featured/goodnotes.png'),
                    'link_1' => '',
                    'platforms' => 'windows,mac,linux,web,android,ios',
                    'publisher_slug' => '',
                    'entity_type' => 'software',
                    "tags" => ["Word Processor", "Text Editor", "PDF annotation", "Export to PDF"]
                ],
                [
                    'title' => 'WPS Office Writer Free',
                    'slug' => 'wps-office-writer-free',
                    'description' => 'WPS Office Free Writer is a free alternative software program for Microsoft office, it is available for Windows, Android, IOS, and Linux making it available for cross platforms. Its functions are similar to the Microsoft office making it very easy to use and having a friendly user interface, perhaps its most notable function is being able to open an MS word file without compromising the content of the document making it usable in any type of platform. Most of the users of this software would include people who are using small devices such as a smartphone, and tablet who cannot fully display an entire Microsoft office file due to hardware configurations and since it is free the user will no longer have to worry about the subscription fees, and premium contents since the free version are already packed with great features perfect for everyday use making it one of the greatest software applications.',
                    'logo' => asset('img/logo/wps-writer.png'),
                    'link_1' => '',
                    'platforms' => 'windows,mac,linux',
                    'publisher_slug' => 'wps',
                    'entity_type' => 'software',
                    "tags" => ["Word Processor", "Text Editor", "Export to PDF"]
                ],
                [
                    'title' => 'FocusWriter',
                    'slug' => 'focuswriter',
                    'description' => 'FocusWriter is an open code software designed by Grame Gott, which was created as an alternative to other text editors to make our writing easier and free of distractions. It\'s interface is absolutely clean,and in comparison with other text editors it doesn\'t show a toolbar until we put the cursor on the top of the screen. The software offers some interesting features such as spell check, autosave, support of .txt, .rft and .odt documents, timers, and customizable themes.  This software is perfect for those of us who like working in a very clean space where we can\'t do anything else but focus on our work. FocusWriter not only has a clean interface, it also has some tools such as highlighting one part of the text while attenuating the rest, so you are even more focused in the part you are reading, writing or editing. It is definitely a very comfortable tool that can be used for many purposes while staying concentrated and efficient.',
                    'logo' => asset('img/logo/focuswriter.png'),
                    'link_1' => '',
                    'platforms' => 'windows,mac,linux',
                    'publisher_slug' => 'focuswriter',
                    'entity_type' => 'software',
                    "tags" => ["Word Processor", "Text Editor", "Export to PDF"]
                ],
                [
                    'title' => 'FreeOffice TextMaker',
                    'slug' => 'freeoffice-textmaker',
                    'description' => 'FreeOffice is the free version of SoftMaker Office, which was developed in 1987 by a german company called SoftMaker Software GmbH. This free version was launched in 2006 and is compatible with Windows, Linux and Mac OS.  FreeOffice is an ofimatic suite that includes text processing, spreadsheet and presentation sheet tools as a free alternative to Microsoft Office softwares, but being compatible with them at the same time. It has very similar features to those Microsoft programs (Word, Excel, PowerPoint) , allowing you to edit, write and save documents in microsoft formats. The software includes four different components, text maker is the word porcessor, plan maker the spreadsheet, softmaker presentations the presentation tool, and basicmaker a programming tool.  If you are looking for a software similar to those of Microsoft office but you don\'t want to spend money on it FreeOffice is definitely a good choice. You could do your documents at home with it and then bring them to your workplace or study place and open that documents in microsoft applications.',
                    'logo' => asset('img/logo/softmaker-freeoffice.png'),
                    'link_1' => '',
                    'platforms' => 'windows,mac,linux',
                    'publisher_slug' => 'softmaker',
                    'entity_type' => 'software',
                    "tags" => ["Word Processor", "Text Editor", "Export to PDF"]
                ],
                [
                    'title' => 'Quip',
                    'slug' => 'quip',
                    'description' => 'Quip is a productivity software founded in 2012 by Bret Taylor, who is a co-creator of the well known tool "Google Maps" and an ex worker of Facebook Inc.. It was firstly launched as a website in 2012 but one year later the company launched a mobile phone app.  This software allows people to create and edit documents together, and also has a spreadsheet tool, which makes this software very useful for businesses. Quip allows everyone to edit the same document at the same time, showing the history of versions and who and when made each of the changes in the document. Even thought you don\'t have internet connection at a particular moment, you can still use every tool, creating and editing the documents during that time and right after you recover internet connection the changes will automatically be shown to the rest of the persons inside the document. It also gives you the chance to mention someone with an @, and that person will get a notification on his phone, perfect for giving a touch of attention to those mates who take advantage of group works.  Quip is a very useful app that can be used for editing documents with your workmates or classmates and works very efficiently, with an instant update of the new information that makes group work very comfortable to do.',
                    'logo' => asset('img/logo/quip.png'),
                    'link_1' => '',
                    'platforms' => 'windows,mac,linux',
                    'publisher_slug' => 'quip',
                    'entity_type' => 'software',
                    "tags" => ["Word Processor", "Text Editor", "Export to PDF"]
                ],
            ]
            , "word-processor");
    }
}

/*
 *
 [
    'title' => '',
    'slug' => '',
        'description' => '',
    'logo' => "",

    'link_1' => '',
    'platforms' => 'windows,mac,linux,web,android,ios',
    'publisher_slug' => '',
    'entity_type' => 'software',
    "tags" => [""]
]
 *
 */
