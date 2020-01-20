<?php

use App\Setting;
use App\Timeline;
use App\User;
use Illuminate\Database\Seeder;

class InstallerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Create admin account
        $account = Timeline::firstOrNew(['username' => 'zedcoinuser']);
        $account->username = 'zedcoinuser';
        $account->name = 'Admin';
        $account->about = 'Some text about me';
        $account->type = 'user';
        $account->save();

        $user = User::create([
            'timeline_id'       => 1,
            'email'             => 'admin@zedcoin.com',
            'verification_code' => str_random(18),
            'remember_token'    => str_random(10),
            'password'          => Hash::make('zedcoin'),
            'city'              => 'Hyderabad',
            'country'           => 'India',
            'gender'            => 'male',
            'email_verified'    => 1,
        ]);

        $user_settings = [
            'user_id'               => $user->id,
            'confirm_follow'        => 'no',
            'follow_privacy'        => 'everyone',
            'comment_privacy'       => 'everyone',
            'timeline_post_privacy' => 'everyone',
            'message_privacy'       => 'everyone',
            'post_privacy'          => 'everyone', ];

        $userSettings = DB::table('user_settings')->insert($user_settings);

        $user->roles()->attach(1);

        //Create default website settings

        $settings = ['comment_privacy'                => 'everyone',
                        'confirm_follow'              => 'no',
                        'follow_privacy'              => 'everyone',
                        'user_timeline_post_privacy'  => 'everyone',
                        'post_privacy'                => 'everyone',
                        'page_message_privacy'        => 'everyone',
                        'page_timeline_post_privacy'  => 'everyone',
                        'page_member_privacy'         => 'only_admins',
                        'member_privacy'              => 'only_admins',
                        'group_timeline_post_privacy' => 'members',
                        'group_member_privacy'        => 'only_admins',
                        'site_name'                   => 'Zedcoin',
                        'site_title'                  => 'Zedcoin',
                        'site_url'                    => 'Zedcoin.dev',
                        'twitter_link'                => 'http://twitter.com/',
                        'facebook_link'               => 'http://facebook.com/',
                        'youtube_link'                => 'http://youtube.com/',
                        'support_email'               => 'admin@Zedcoin.com',
                        'mail_verification'           => 'off',
                        'captcha'                     => 'off',
                        'censored_words'              => '',
                        'birthday'                    => 'off',
                        'city'                        => 'off',
                        'about'                       => 'Zedcoin is a Social networking application developed to help users make money and uses MTN MOMO API, Pixel perfect design and extremely user friendly. User interface and user experience are extra added features to Zedcoin.',
                        'contact_text'                => 'Contact page description can be here',
                        'address_on_mail'             => 'Zedcoin,<br> Zedcoin street,<br> India',
                        'items_page'                  => '10',
                        'min_items_page'              => '5',
                        'user_message_privacy'        => 'everyone',
                        'group_event_privacy'         => 'only_admins',
                        'footer_languages'            => 'on',
                        'linkedin_link'               => 'http://linkedin.com/',
                        'instagram_link'              => 'http://instagram.com/',
                        'dribbble_link'               => 'http://dribbble.com/',
                        'home_welcome_message'        => 'Welcome To Zedcoin Laravel Application',
                            'home_widget_one'             => 'Developed on Twitter Bootstrap which makes the application fully responsive on Desktop, Tablet and Mobile',
                            'home_widget_two'             => 'Powerful Admin panel to manage entire application and all kinds of timelines',
                            'home_widget_three'           => 'Emoticons, hashtags, music, youtube video, photos, hangouts and many others can be posted',
                            'home_list_heading'           => 'Enhancing Features of Zedcoin',
                            'home_feature_one_icon'       => 'users',
                            'home_feature_one'            => 'Depost or withdraw from your Zedcoin Account',
                            'home_feature_two_icon'       => 'share-alt',
                            'home_feature_two'            => 'Buy Shares using MTN Mobile Money',
                            'home_feature_three_icon'       => 'link',
                            'home_feature_three'            => 'Pay for socialfund',
                            'home_feature_four_icon'       => 'bullhorn',
                            'home_feature_four'            => 'Request for loans and pay your loans using Momo account',
                            'home_feature_five_icon'       => 'connectdevelop',
                            'home_feature_five'            => 'Connect to Zedcoin receive payments through your mtn mobile',
                            'home_feature_six_icon'       => 'save',
                            'home_feature_six'            => 'See how much money you made in month',
                            'home_feature_seven_icon'       => 'file-photo-o',
                            'home_feature_seven'            => 'Get inspired by how much your friends are making',
                            'home_feature_eight_icon'       => 'flag-o',
                            'home_feature_eight'            => 'Create Zedcoin group and start making money',
                            'home_feature_nine_icon'       => 'language',
                            'home_feature_nine'            => 'Zedcoin is multi-lingual and available in 16 languages',
                            'home_feature_ten_icon'       => 'user-plus',
                            'home_feature_ten'            => 'and other interesting features coming soon',
                        ];

        foreach ($settings as $key => $value) {
            $settings = Setting::firstOrNew(['key' => $key, 'value' => $value]);
            $settings->save();
        }
    }
}
