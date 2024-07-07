<?php

namespace App\Console\Commands;

use App\Models\Blog;
use App\Models\BusinessModel;
use App\Models\Investor;
use App\Models\LandingPage;
use App\Models\MckinseyModel;
use App\Models\Note;
use App\Models\PestAnalysis;
use App\Models\PestelAnalysis;
use App\Models\PorterModel;
use App\Models\Projects;
use App\Models\Setting;
use App\Models\StartupCanvas;
use App\Models\SubscriptionPlan;
use App\Models\SwotAnalysis;
use App\Models\Task;
use App\Models\Todo;
use App\Models\User;
use App\Models\Workspace;
use Faker\Factory;
use Faker\Provider\Image;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CreateDemo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:demo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        if (config("app.env") == "production") {
            $this->error(
                "This command should not be run in production environment."
            );
            return 1;
        }

        $this->info("Creating demo data...");

        Artisan::call("migrate:refresh --seed");

        $data = [
            'company_name' => 'CloudOnex'
        ];

        $workspace = Workspace::first();


        foreach ($data as $key => $value) {

            $setting = Setting::where('key', $key)->first();

            if (!$setting) {
                $setting = new Setting();
                $setting->key = $key;
                $setting->workspace_id = $workspace->id;
            }

            $setting->value = $value;
            $setting->workspace_id = $workspace->id;
            $setting->save();

        }
        $faker = Factory::create();

        $created_users_ids = [];

        if (app()->environment('local', 'demo')) {
            //Create additional users for demo

            for ($i = 0; $i < 50; $i++) {

                $user = new User();
                $user->workspace_id = 1;
                $user->first_name = $faker->firstName;
                $user->last_name = $faker->lastName;
                $user->email = $faker->email;
                $user->password = Hash::make(Str::random());
                $user->save();

                $created_users_ids[] = $user->id;

            }
            $workspace_id = $user->workspace_id;


            $today = date('Y-m-d');


            $landingpage = [
                [
                    "admin_id" => "1",
                    "hero_title" => "StartupKit-Build your dream business",
                    "hero_subtitle" => "Unleash Your Vision, Design Your Success",
                    "background_image" => "media/team.jpg",
                    "hero_paragraph" => "Whether you're a startup founder, an aspiring entrepreneur, or a business strategist, this powerful tool empowers you to craft winning business models with ease and precision",

                    "feature1_title" => "Empowering Your Vision: Streamline Your Business Planning Journey with Precision and Ease",
                    "feature1_subtitle" => "Our business planning software is designed to turn your business vision into a structured, actionable plan.",
                    "feature1_one" => "Business Model Canvas",
                    "feature1_one_paragraph" => "The Business Model Canvas is a strategic management and lean startup template for developing new or documenting existing business models.",
                    "feature1_two" => "Lean Canvas",
                    "feature1_two_paragraph" => "The Lean Canvas is a strategic management and lean startup template that is used to develop and document a business model.",
                    "feature1_three" => "SWOT Analysis",
                    "feature1_three_paragraph" => "SWOT analysis is a strategic planning technique used to help a person or organization identify strengths, weaknesses, opportunities, and threats related to business competition or project planning.",
                    "feature1_four" => "Lean Startup",
                    "feature1_four_paragraph" => "The Lean Startup is a method for developing businesses and products that aims to shorten product development cycles and rapidly discover.",
                    "feature1_five" => "Business Plan",
                    "feature1_five_paragraph" => "A business plan is a formal written document containing the goals of a business, the methods for attaining those goals, and the time-frame for the achievement of the goals.",
                    "feature1_six" => "Pestle Analysis",
                    "feature1_six_paragraph" => "PESTLE analysis, which is sometimes referred to as PEST analysis, is a concept in marketing principles. Moreover.",


                    "feature1_image" => "media/hero.png",
                    "feature1_image_title" => "Streamline Your Business Planning Journey with Precision and Ease",
                    "feature1_image_subtitle" => "Take action on your dream business, Unleash your entrepreneurial spirit with our innovative business planning software.",
                    "feature2_title" => "Business Planning Software",
                    "feature2_subtitle" => "Our business planning software is designed to turn your business vision into a structured, actionable plan.",
                    "feature2_one" => "Business Model Canvas",
                    "feature2_one_paragraph" => "The Business Model Canvas is a strategic management and lean startup template for developing new business models.",
                    "feature2_two" => "Team Discussions",
                    "feature2_two_paragraph" => "Team Discussions provide a dedicated space for conversations related to specific projects, tasks, or topics.",
                    "feature2_three" => "Product Planning",
                    "feature2_three_paragraph" => "Product planning feature is an essential component for businesses looking to introduce new products or refine existing ones.",
                    "feature2_four" => "Lean Startup",
                    "feature2_four_paragraph" => "The Lean Startup is a method for developing businesses and products that aims to shorten product development cycles and rapidly discover.",
                    "feature2_five" => "Business Plan",
                    "feature2_five_paragraph" => "A business plan is a formal written document containing the goals of a business.",
                    "feature2_six" => "Ideation Canvas",
                    "feature2_six_paragraph" => "The canvas acts as a common ground where all members can contribute, providing structure to otherwise chaotic and spontaneous processes.",
                    "feature2_seven" => "Business Model Canvas",

                    "feature2_seven_paragraph" => "The canvas acts as a common ground where all members can contribute, providing structure to otherwise chaotic and spontaneous processes.",

                    "feature2_eight" => "Business Model Canvas",
                    "feature2_eight_paragraph" => "The canvas acts as a common ground where all members can contribute, providing structure to otherwise chaotic and spontaneous processes.",

                    "feature2_image" => "media/story.jpg",
                    "feature2_image_title" => "Build the business of your dreams",
                    "feature2_image_subtitle" => "Take action on your dream business, Unleash your entrepreneurial spirit with our innovative business planning software.",

                    "story1_title" => "Creating Business strategies is super simple now",
                    "story1_paragrapgh" => "In essence, a business strategy is a roadmap or guide towards achieving a company's objectives. It outlines the steps to take, the resources needed. The business strategy also guides many of your organizational decisions, such as hiring new employees.",
                    "story1_image" => "media/story2.jpg",

                    "story2_title" => "Write Pest, Swot, Pestel Analysis with ease",
                    "story2_paragrapgh" => "Our business planning software is designed to turn your business vision into a structured, actionable plan. A business plan is a formal written document containing the goals of a business, the methods for attaining those goals, and the time-frame for the achievement of the goals.",
                    "story2_image" => "media/sample.jpg",
                    "calltoaction_title" => "Build the business of your dreams",
                    "calltoaction_subtitle" => "Take action on your dream business, Unleash your entrepreneurial spirit with our innovative business planning software.",

                ],

            ];


            foreach ($landingpage as $page) {
                $lpage = new LandingPage();
                $lpage->hero_title = $page["hero_title"];
                $lpage->hero_subtitle = $page["hero_subtitle"];
                $lpage->hero_paragraph = $page["hero_paragraph"];
                $lpage->background_image = $page["background_image"];
                $lpage->feature1_one = $page["feature1_one"];
                $lpage->feature1_one_paragraph = $page["feature1_one_paragraph"];
                $lpage->feature1_two = $page["feature1_two"];
                $lpage->feature1_two_paragraph = $page["feature1_two_paragraph"];
                $lpage->feature1_three = $page["feature1_three"];
                $lpage->feature1_three_paragraph = $page["feature1_three_paragraph"];
                $lpage->feature1_four = $page["feature1_four"];
                $lpage->feature1_four_paragraph = $page["feature1_four_paragraph"];
                $lpage->feature1_five = $page["feature1_five"];
                $lpage->feature1_five_paragraph = $page["feature1_five_paragraph"];
                $lpage->feature1_six = $page["feature1_six"];
                $lpage->feature1_six_paragraph = $page["feature1_six_paragraph"];
                $lpage->feature1_image = $page["feature1_image"];
                $lpage->feature1_image_title = $page["feature1_image_title"];
                $lpage->feature1_image_subtitle = $page["feature1_image_subtitle"];
                $lpage->feature2_title = $page["feature2_title"];
                $lpage->feature2_subtitle = $page["feature2_subtitle"];
                $lpage->feature2_one = $page["feature2_one"];
                $lpage->feature2_one_paragraph = $page["feature2_one_paragraph"];
                $lpage->feature2_two = $page["feature2_two"];
                $lpage->feature2_two_paragraph = $page["feature2_two_paragraph"];
                $lpage->feature2_three = $page["feature2_three"];
                $lpage->feature2_three_paragraph = $page["feature2_three_paragraph"];
                $lpage->feature2_four = $page["feature2_four"];
                $lpage->feature2_four_paragraph = $page["feature2_four_paragraph"];
                $lpage->feature2_five = $page["feature2_five"];
                $lpage->feature2_five_paragraph = $page["feature2_five_paragraph"];

                $lpage->feature2_seven = $page["feature2_seven"];
                $lpage->feature2_seven_paragraph = $page["feature2_seven_paragraph"];
                $lpage->feature2_eight = $page["feature2_eight"];
                $lpage->feature2_eight_paragraph = $page["feature2_eight_paragraph"];
                $lpage->feature2_six = $page["feature2_six"];
                $lpage->feature2_six_paragraph = $page["feature2_six_paragraph"];
                $lpage->story1_title = $page["story1_title"];
                $lpage->story1_paragrapgh = $page["story1_paragrapgh"];
                $lpage->story1_image = $page["story1_image"];
                $lpage->story2_title = $page["story2_title"];
                $lpage->story2_paragrapgh = $page["story2_paragrapgh"];
                $lpage->story2_image = $page["story2_image"];
                $lpage->calltoaction_title = $page["calltoaction_title"];
                $lpage->calltoaction_subtitle = $page["calltoaction_subtitle"];
                $lpage->save();
            }


//
//        $this->seed($data);




            $sample_projects = [
                [
                    'title' => 'Personalized Health Monitoring Platform',
                    'uuid' => Str::uuid(),
                    'start_date' => '2023-12-31',
                    'end_date' => '2023-12-31',
                    'status' => 'Pending',
                    'members' => ["1"],
                    'summary' => 'This would analyze biometric data, dietary habits, sleep patterns, etc., to provide tailored health recommendations, medication reminders, and connect with healthcare providers if necessary',
                    'description' => 'A wearable device combined with AI-driven software that provides personalized health monitoring, coaching, and insights. This would analyze biometric data, dietary habits, sleep patterns, etc., to provide tailored health recommendations, medication reminders, and connect with healthcare providers if necessary'


                ],
                [
                    'title' => 'Sustainable Urban Farming Solutions',
                    'uuid' => Str::uuid(),
                    'start_date' => '2023-12-31',
                    'end_date' => '2023-12-31',
                    'status' => 'Started',
                    'summary' => 'A modular and scalable vertical farming system that can be installed in urban environments like homes.',
                    'description' => 'A modular and scalable vertical farming system that can be installed in urban environments like homes, schools, or community centers. Utilizing hydroponic or aquaponic technology, it would aim to provide fresh, organic produce locally, reducing transportation costs and environmental impact.'


                ],
                [
                    'title' => 'AR-enhanced Education Platform',
                    'uuid' => Str::uuid(),
                    'start_date' => '2023-12-31',
                    'end_date' => '2023-12-31',
                    'status' => 'Finished',
                    'summary' => 'By harnessing the power of AI, we aim to enhance productivity, efficiency, and accuracy in fields such as healthcare, finance, manufacturing.',
                    'description' => 'A platform that uses Augmented Reality (AR) to enhance traditional learning materials, allowing students to engage with 3D models, simulations, and interactive lessons. It could be designed for subjects like science, history, or art, offering a more immersive and engaging educational experience'


                ],
                [
                    'title' => 'Responsible E-waste Recycling Service',
                    'uuid' => Str::uuid(),
                    'start_date' => '2023-12-31',
                    'end_date' => '2023-12-31',
                    'status' => 'Started',
                    'summary' => 'A service that provides an easy and environmentally responsible way to recycle electronic waste',
                    'description' => 'A service that provides an easy and environmentally responsible way to recycle electronic waste. Through a subscription model or a one-time service, customers could schedule pickups or locate drop-off points for their old electronics. The service would then ensure that the e-waste is recycled or repurposed in line with best environmental practices'


                ],
                [
                    'title' => 'Blockchain-based Supply Chain Transparency Tool',
                    'uuid' => Str::uuid(),
                    'start_date' => '2023-12-31',
                    'end_date' => '2023-12-31',
                    'status' => 'Finished',
                    'summary' => 'A platform leveraging blockchain technology to offer full transparency in product supply chains. Manufacturers, suppliers, and consumers can track the origin, handling, and quality control information of products, fostering accountability and sustainability.',
                    'description' => 'A platform leveraging blockchain technology to offer full transparency in product supply chains. Manufacturers, suppliers, and consumers can track the origin, handling, and quality control information of products, fostering accountability and sustainability.'


                ],
                [
                    'title' => 'Zero-waste Packaging as a Service',
                    'start_date' => '2023-12-31',
                    'uuid' => Str::uuid(),
                    'end_date' => '2023-12-31',
                    'status' => 'Pending',
                    'summary' => 'By harnessing the power of AI, we aim to enhance productivity, efficiency, and accuracy in fields such as healthcare, finance, manufacturing.',
                    'description' => 'This project aims to develop and implement AI products that revolutionize various industries. Leveraging cutting-edge machine learning techniques, our products will provide advanced solutions for automation, decision-making, and predictive analysis. By harnessing the power of AI, we aim to enhance productivity, efficiency, and accuracy in fields such as healthcare, finance, manufacturing, and customer service. Our products will enable businesses to streamline their operations, optimize resource allocation, and deliver personalized experiences to their customers. Through continuous research and innovation, we strive to push the boundaries of AI technology and create transformative products that drive growth and success in the digital era..'


                ],
                [
                    'title' => 'Artificial Intelligence (COMP300)',
                    'uuid' => Str::uuid(),
                    'start_date' => '2023-12-31',
                    'end_date' => '2023-12-31',
                    'status' => 'Started',
                    'summary' => 'By harnessing the power of AI, we aim to enhance productivity, efficiency, and accuracy in fields such as healthcare, finance, manufacturing.',
                    'description' => 'Enter the world of algorithms, programming, and problem-solving as you embark on a journey through computer science. Learn the foundations of computing, software development, data structures, and algorithms, while exploring emerging technologies like artificial intelligence and machine learning.'


                ],
                [
                    'title' => 'Responsible E-waste Recycling Service',
                    'uuid' => Str::uuid(),
                    'start_date' => '2023-12-31',
                    'end_date' => '2023-12-31',
                    'status' => 'Started',
                    'summary' => 'Enter the world of algorithms, programming, and problem-solving as you embark on a journey through computer science.',
                    'description' => 'This project aims to develop and implement AI products that revolutionize various industries. Leveraging cutting-edge machine learning techniques, our products will provide advanced solutions for automation, decision-making, and predictive analysis. By harnessing the power of AI, we aim to enhance productivity, efficiency, and accuracy in fields such as healthcare, finance, manufacturing, and customer service. Our products will enable businesses to streamline their operations, optimize resource allocation, and deliver personalized experiences to their customers. Through continuous research and innovation, we strive to push the boundaries of AI technology and create transformative products that drive growth and success in the digital era..'


                ],
                [
                    'title' => 'Personalized Nutrition Service:',
                    'start_date' => '2023-12-31',
                    'uuid' => Str::uuid(),
                    'end_date' => '2023-12-31',
                    'status' => 'Pending',
                    'summary' => 'Analyze and apply the principles of financial management, including capital budgeting, financial analysis, risk assessment. ',
                    'description' => 'An AI-powered platform that crafts personalized meal plans, grocery lists, and cooking instructions based on individual dietary needs, preferences, health goals, and allergies. It could also connect to local grocery delivery services for an end-to-end solution.'


                ],
            ];

            foreach ($sample_projects as $sample_project) {

                //Random 2 or 3 user ids
                $random_users_ids = Arr::random($created_users_ids, rand(2, 3));

                $project = new Projects();
                $project->workspace_id = $workspace_id;
                $project->uuid = Str::uuid();
                $project->admin_id = $user->id;
                $project->title = $sample_project['title'];
                $project->description = $sample_project['description'];
                $project->start_date = $sample_project['start_date'];
                $project->end_date = $sample_project['end_date'];
                $project->status = $sample_project['status'];

                $project->members = json_encode($random_users_ids);

                $project->summary = $sample_project['summary'];
                $project->description = $sample_project['description'];
                $project->save();
            }

        }

        $sample_todos = [
            [
                'subject' => 'Write 5 blog posts for Techhub',
                'description' => 'Write 5 blog posts for Techhub about entrepreneurship.',
                'start_date' => '2023-12-31',
                'due_date' => '2023-12-31',
                'status' => 'Started',
                'contact_id' => 2,


            ],
            [
                'subject' => 'Create a detailed project plan outlining tasks and timelines.',
                'description' => 'Create a detailed project plan outlining tasks and timelines.',
                'start_date' => '2023-04-09',
                'due_date' => '2023-12-31',
                'status' => 'Started',
                'contact_id' => 1,

            ],[
                'subject' => 'Gather requirements from stakeholders and end-users.',
                'description' => 'Gather requirements from stakeholders and end-users.',
                'due_date' => '2023-09-23',
                'start_date' => '2023-04-09',
                'status' => 'Finished',
                'contact_id' => 6,

            ],[
                'subject' => 'Implement data collection and storage mechanisms.',
                'description' => 'Write 5 blog posts for Techhub about entrepreneurship.',
                'start_date' => '2023-12-31',
                'due_date' => '2023-12-31',
                'status' => 'In Progress',
                'contact_id' => 3,

            ],[
                'subject' => 'Build and train the AI model using appropriate algorithms',
                'description' => 'Write 5 blog posts for Techhub about entrepreneurship.',
                'start_date' => '2023-04-09',
                'due_date' => '2023-12-31',
                'status' => 'Started',
                'contact_id' => 4,

            ],[
                'subject' => 'Test the AI model for accuracy, performance, and scalability',
                'description' => 'Write 5 blog posts for Techhub about entrepreneurship.',
                'due_date' => '2023-12-31',
                'start_date' => '2023-04-09',
                'status' => 'In Progress',
                'contact_id' => 2,

            ],[
                'subject' => 'Optimize the AI model for efficiency and resource utilization',
                'description' => 'Write 5 blog posts for Techhub about entrepreneurship.',
                'start_date' => '2023-02-03',
                'due_date' => '2023-12-31',
                'status' => 'Finished',
                'contact_id' => 1,

            ],[
                'subject' => 'Develop a robust backend infrastructure to support the AI product',
                'description' => 'Write 5 blog posts for Techhub about entrepreneurship.',
                'start_date' => '2023-32-01',
                'due_date' => '2023-12-31',
                'status' => 'Started',
                'contact_id' => 3,


            ],[
                'subject' => 'Implement real-time monitoring and logging for system health.',
                'description' => 'Write 5 blog posts for Techhub about entrepreneurship.',
                'start_date' => '2023-04-09',
                'due_date' => '2023-12-31',
                'status' => 'In Progress',
                'contact_id' => 5,


            ],[
                'subject' => 'Develop a marketing strategy to promote the AI product.',
                'description' => 'Write 5 blog posts for Techhub about entrepreneurship.',
                'start_date' => '2023-10-31',
                'due_date' => '2023-12-31',
                'status' => 'Finished',
                'contact_id' => 2,


            ],[
                'subject' => 'Establish partnerships with industry influencers or collaborators.',
                'description' => 'Write 5 blog posts for Techhub about entrepreneurship.',
                'start_date' => '2024-10-31',
                'due_date' => '2023-12-31',
                'status' => 'Started',
                'contact_id' => 4,


            ],[
                'subject' => 'Explore opportunities for expanding the AI product into new markets.',
                'description' => 'Write 5 blog posts for Techhub about entrepreneurship.',
                'start_date' => '2023-8-13',
                'due_date' => '2023-8-13',
                'status' => 'Finished',
                'contact_id' => 8,


            ],[
                'subject' => 'Conduct regular security audits and implement necessary updates.',
                'description' => 'Write 5 blog posts for Techhub about entrepreneurship.',
                'start_date' => '2023-2-23',
                'due_date' => '2023-2-23',
                'status' => 'Started',
                'contact_id' => 7,


            ],[
                'subject' => 'Conduct A/B testing to optimize user interfaces and features.',
                'description' => 'Write 5 blog posts for Techhub about entrepreneurship.',
                'start_date' => '2023-12-11',
                'due_date' => '2023-12-11',
                'status' => 'Finished',
                'contact_id' => 6,


            ],[
                'subject' => 'Plan for regular updates and feature enhancements based on user needs.',
                'description' => 'Write 5 blog posts for Techhub about entrepreneurship.',
                'due_date' => '2023-10-12',
                'start_date' => '2023-10-12',
                'status' => 'Started',
                'contact_id' => 5,

            ],[
                'subject' => 'Implement a feedback loop for continuous learning and improvement.',
                'description' => 'Write 5 blog posts for Techhub about entrepreneurship.',
                'due_date' => '2023-7-21',
                'start_date' => '2023-7-21',
                'status' => 'In Progress',
                'contact_id' => 4,


            ],[
                'subject' => 'Write 5 blog posts for Techhub',
                'description' => 'Write 5 blog posts for Techhub about entrepreneurship.',
                'due_date' => '2023-2-31',
                'start_date' => '2023-2-31',
                'contact_id' => 3,
                'status' => 'Finished',

            ],[
                'subject' => 'Continuously evaluate and enhance the user experience.',
                'description' => 'Write 5 blog posts for Techhub about entrepreneurship.',
                'due_date' => '2023-12-31',
                'contact_id' => 2,
                'start_date' => '2023-12-31',
                'status' => 'Started',

            ],[
                'subject' => 'Collect and analyze user feedback for continuous improvement.',
                'description' => 'Write 5 blog posts for Techhub about entrepreneurship.',
                'due_date' => '2023-12-31',
                'contact_id' => 1,
                'start_date' => '2023-12-31',
                'status' => 'In Progress',

            ],
        ];

        foreach ($sample_todos as $sample_todo)
        {
            $todo = new Task();
            $todo->workspace_id = $workspace_id;
            $todo->uuid = Str::uuid();
            $todo->contact_id= $sample_todo['contact_id'];
            $todo->subject = $sample_todo['subject'];
            $todo->status = $sample_todo['status'];
            $todo->description = $sample_todo['description'];
            $todo->start_date = $sample_todo['start_date'];
            $todo->due_date = $sample_todo['due_date'];
            $todo->save();
        }



        $sample_notes = [
            [
                'title'=>'Decentralized Renewable Energy Grids',
                'notes'=>'Developing community-based microgrids that rely on renewable energy sources like solar and wind power. These grids could operate independently or connect to larger grids, providing energy resilience and supporting sustainability at a local level.',
                'topic' => 'Energy',
                'admin_id' => $user->id,
                'cover_photo'=> "media/team.jpg"

            ],
            [
                'title'=>'How to Build a Startup That succeeds',
                'notes'=>'Developing community-based microgrids that rely on renewable energy sources like solar and wind power. These grids could operate independently or connect to larger grids, providing energy resilience and supporting sustainability at a local level.',
                'topic' => 'Business',
                'admin_id' => $user->id,
                'cover_photo'=> "media/hero.png"

            ],
            [
                'title'=>'How to write a business plan',
                'notes'=>'Developing community-based microgrids that rely on renewable energy sources like solar and wind power. These grids could operate independently or connect to larger grids, providing energy resilience and supporting sustainability at a local level.',
                'topic' => 'Business',
                'admin_id' => $user->id,
                'cover_photo'=> "media/hero-1.png"

            ],
        ];

        foreach ($sample_notes as $sample_note)
        {
            $note = new Note();
            $note->workspace_id = $workspace_id;
            $note->uuid = Str::uuid();
            $note->admin_id = $sample_note['admin_id'];
            $note->title = $sample_note['title'];
            $note->notes = $sample_note['notes'];
            $note->topic = $sample_note['topic'];
            $note->cover_photo = $sample_note['cover_photo'];
            $note->save();

        }

        $sample_blogs = [
            [
                'title'=>'Decentralized Renewable Energy Grids',
                'slug'=>'decentralized-renewable-energy-grids',
                'notes'=>'Developing community-based microgrids that rely on renewable energy sources like solar and wind power. These grids could operate independently or connect to larger grids, providing energy resilience and supporting sustainability at a local level. An AI-powered platform that crafts personalized meal plans, grocery lists, and cooking instructions based on individual dietary needs, preferences, health goals, and allergies. It could also connect to local grocery delivery services for an end-to-end solution. It could also connect to local grocery delivery services for an end-to-end solution. It could also connect to local grocery delivery services for an end-to-end solution.

                A platform leveraging blockchain technology to offer full transparency in product supply chains. Manufacturers, suppliers, and consumers can track the origin, handling, and quality control information of products, fostering accountability and sustainability.
                A combination of IoT devices and AI-driven algorithms that provide comprehensive in-home care for elderly individuals. It includes features like fall detection, medication reminders, health monitoring, and emergency contact capabilities, allowing family members to keep an eye on their loved ones remotely. Manufacturers, suppliers, and consumers can track the origin, handling, and quality control information of products, fostering accountability and sustainability.
                A platform leveraging blockchain technology to offer full transparency in product supply chains. Manufacturers, suppliers, and consumers can track the origin, handling, and quality control information of products, fostering accountability and sustainability.These grids could operate independently or connect to larger grids, providing energy resilience and supporting sustainability at a local level. An AI-powered platform that crafts personalized meal plans, grocery lists, and cooking instructions based on individual dietary needs, preferences, health goals, and allergies. It could also connect to local grocery delivery services for an end-to-end solution.
                These grids could operate independently or connect to larger grids, providing energy resilience and supporting sustainability at a local level. An AI-powered platform that crafts personalized meal plans, grocery lists, and cooking instructions based on individual dietary needs, preferences, health goals, and allergies. It could also connect to local grocery delivery services for an end-to-end solution.
                ',
                'topic' => 'Energy',
                'admin_id' => $user->id,
                'cover_photo'=> "media/team.jpg"

            ],
            [
                'title'=>'How to Build a Startup That succeeds',
                'slug'=>'how-to-build-a-startup-that-succeeds',
                'notes'=>'Developing community-based microgrids that rely on renewable energy sources like solar and wind power. These grids could operate independently or connect to larger grids, providing energy resilience and supporting sustainability at a local level. An AI-powered platform that crafts personalized meal plans, grocery lists, and cooking instructions based on individual dietary needs, preferences, health goals, and allergies. It could also connect to local grocery delivery services for an end-to-end solution.
                A combination of IoT devices and AI-driven algorithms that provide comprehensive in-home care for elderly individuals. It includes features like fall detection, medication reminders, health monitoring, and emergency contact capabilities, allowing family members to keep an eye on their loved ones remotely.',
                'topic' => 'Business',
                'admin_id' => $user->id,
                'cover_photo'=> "media/hero.png"

            ],
            [
                'title'=>'How to write a business plan',
                'slug'=>'how-to-write-a-business-plan',
                'notes'=>'Developing community-based microgrids that rely on renewable energy sources like solar and wind power. These grids could operate independently or connect to larger grids, providing energy resilience and supporting sustainability at a local level. An AI-powered platform that crafts personalized meal plans, grocery lists, and cooking instructions based on individual dietary needs, preferences, health goals, and allergies. It could also connect to local grocery delivery services for an end-to-end solution.
                               A combination of IoT devices and AI-driven algorithms that provide comprehensive in-home care for elderly individuals. It includes features like fall detection, medication reminders, health monitoring, and emergency contact capabilities, allowing family members to keep an eye on their loved ones remotely. Manufacturers, suppliers, and consumers can track the origin, handling, and quality control information of products, fostering accountability and sustainability.
                               A platform leveraging blockchain technology to offer full transparency in product supply chains. Manufacturers, suppliers, and consumers can track the origin, handling, and quality control information of products, fostering accountability and sustainability.',
                'topic' => 'Business',
                'admin_id' => $user->id,
                'cover_photo'=> "media/hero-1.png"

            ],
        ];

        foreach ($sample_blogs as $sample_blog)
        {
            $note = new Blog();
            $note->workspace_id = $workspace_id;
            $note->uuid = Str::uuid();
            $note->admin_id = $sample_blog['admin_id'];
            $note->title = $sample_blog['title'];
            $note->slug = $sample_blog['slug'];
            $note->notes = $sample_blog['notes'];
            $note->topic = $sample_blog['topic'];
            $note->cover_photo = $sample_blog['cover_photo'];
            $note->save();

        }


        $sample_investors= [
            [
                'first_name'=>'John',
                'last_name'=>'Doe',
                'phone_number'=>'+987645678',
                'email'=>'jhon@example.com',
                'workspace_id'=>$workspace_id,
                'product_id'=>1,
                'notes'=>'John Doe is a Kenyan investor who is interested in investing in startups in the energy sector',
                'status'=>'Pending',
                'source'=>'Website',
                'amount'=>'50000',


        ],
            [
                'first_name'=>'Russel ',
                'last_name'=>'Arnold',
                'email'=> 'kiara@demo.com',
                'phone_number'=>'+712345678',
                'workspace_id'=>$workspace_id,
                'product_id'=>1,
                'notes'=>'Russel Arnold is a Kenyan investor who is interested in investing in startups in the energy sector',
                'status'=>'Approved',
                'source'=>'Website',
                'amount'=>'10000',



                ],


            [  'first_name'=>'Emily ',
                'last_name'=>'Jones',
                'email'=> 'naila@example.com',
                'phone_number'=>'+144345678',
                'workspace_id'=>$workspace_id,
                'product_id'=>1,
                'notes'=>'Emily Jones is a Kenyan investor who is interested in investing in startups in the energy sector',
                'status'=>'Approved',
                'source'=>'Website',
                'amount'=>'10000',


],
            [  'first_name'=>'Richard ',
                'last_name'=>'Foster',
                'email'=> 'foster@example.com',
                'phone_number'=>'+144235678',
                'workspace_id'=>$workspace_id,
                'product_id'=>1,
                'notes'=>'Emily Jones is a Kenyan investor who is interested in investing in startups in the energy sector',
                'status'=>'Pending',
                'source'=>'Website',
                'amount'=>'10000',


            ],
            [  'first_name'=>'Catherine ',
                'last_name'=>'Jones',
                'email'=> 'jones@example.com',
                'phone_number'=>'+144534678',
                'workspace_id'=>$workspace_id,
                'product_id'=>1,
                'notes'=>'Emily Jones is a Kenyan investor who is interested in investing in startups in the energy sector',
                'status'=>'Approved',
                'source'=>'Website',
                'amount'=>'10000',


            ],
            [  'first_name'=>'Wendy ',
                'last_name'=>'Gibson',
                'email'=> 'gisbon@example.com',
                'phone_number'=>'+141245678',
                'workspace_id'=>$workspace_id,
                'product_id'=>1,
                'notes'=>'Emily Jones is a Kenyan investor who is interested in investing in startups in the energy sector',
                'status'=>'Pending',
                'source'=>'Website',
                'amount'=>'10000',


            ],
            [  'first_name'=>'Lisa ',
                'last_name'=>'Davis',
                'email'=> 'wendy@example.com',
                'phone_number'=>'+144895678',
                'workspace_id'=>$workspace_id,
                'product_id'=>1,
                'notes'=>'Emily Jones is a Kenyan investor who is interested in investing in startups in the energy sector',
                'status'=>'Approved',
                'source'=>'Website',
                'amount'=>'10000',


            ],




        ];

        foreach ($sample_investors as $sample_investor){

            $investor = new Investor();
            $investor->workspace_id = $workspace_id;
            $investor->product_id = $sample_investor['product_id'];
            $investor->first_name = $sample_investor['first_name'];
            $investor->last_name = $sample_investor['last_name'];
            $investor->email = $sample_investor['email'];
            $investor->phone_number = $sample_investor['phone_number'];
            $investor->notes = $sample_investor['notes'];
            $investor->status = $sample_investor['status'];
            $investor->source = $sample_investor['source'];
            $investor->amount = $sample_investor['amount'];

            $investor->save();


        }


        $sample_business_model =[

            [ 'company_name'=>'LifeScience',
                'workspace_id'=>$workspace_id,
                'product_id'=>1,
                'admin_id'=>$user->id,
                'name'=>'Company A',
                'email'=>'demo@example.com',
                'phone'=>'+123456789',
                'partners'=>'Inventory (clothing, accessories).
Technology (website, mobile app, virtual try-on feature).
Relationships with suppliers and manufacturers.
Marketing and customer service teams' ,
                'activities'=>'Managing the online store (website and app).
Inventory management and supply chain coordination.
Marketing and advertising.
Customer support and relationship management.',
                'resources'=>'Inventory (clothing, accessories).
Technology (website, mobile app, virtual try-on feature).
Relationships with suppliers and manufacturers.
Marketing and customer service teams.',
                'value_propositions'=>'Exclusive designs and collaborations with local artists and designers.
Eco-friendly and ethically sourced clothing options.
Personalized shopping experience with virtual try-ons.
Competitive pricing with special discounts and loyalty programs.',
                'customer_relationships'=>'24/7 customer support (chat, email, phone).
Community engagement through social media.
Regular updates on new arrivals, sales, and special events.',
                'channels'=>'E-commerce website.
Mobile app.
Social media platforms (Instagram, Facebook, Twitter).
Email newsletters.',
                'customer_segments'=>'Young adults and fashion enthusiasts (18-35 years).
Eco-conscious consumers.
Individuals looking for unique, custom, and trendy clothing.',
                'cost_structure'=>'Inventory procurement and warehousing.
Website and app development and maintenance.
Marketing and advertising expenses.
Shipping and packaging costs.
Employee salaries and overheads.
',
                'revenue_stream'=>'Direct online sales.
Subscription boxes or membership fees.
Affiliate marketing and collaborations with influencers.',



            ],

            [ 'company_name'=>'RenewableEngeryX',
                'workspace_id'=>$workspace_id,
                'product_id'=>1,
                'admin_id'=>$user->id,
                'name'=>'Company A',
                'email'=>'demo@example.com',
                'phone'=>'+156789',
                'partners'=>'Inventory (clothing, accessories).
Technology (website, mobile app, virtual try-on feature).
Relationships with suppliers and manufacturers.
Marketing and customer service teams' ,
                'activities'=>'Managing the online store (website and app).
Inventory management and supply chain coordination.
Marketing and advertising.
Customer support and relationship management.',
                'resources'=>'Inventory (clothing, accessories).
Technology (website, mobile app, virtual try-on feature).
Relationships with suppliers and manufacturers.
Marketing and customer service teams.',
                'value_propositions'=>'Exclusive designs and collaborations with local artists and designers.
Eco-friendly and ethically sourced clothing options.
Personalized shopping experience with virtual try-ons.
Competitive pricing with special discounts and loyalty programs.',
                'customer_relationships'=>'24/7 customer support (chat, email, phone).
Community engagement through social media.
Regular updates on new arrivals, sales, and special events.',
                'channels'=>'E-commerce website.
Mobile app.
Social media platforms (Instagram, Facebook, Twitter).
Email newsletters.',
                'customer_segments'=>'Young adults and fashion enthusiasts (18-35 years).
Eco-conscious consumers.
Individuals looking for unique, custom, and trendy clothing.',
                'cost_structure'=>'Inventory procurement and warehousing.
Website and app development and maintenance.
Marketing and advertising expenses.
Shipping and packaging costs.
Employee salaries and overheads.
',
                'revenue_stream'=>'Direct online sales.
Subscription boxes or membership fees.
Affiliate marketing and collaborations with influencers.',



            ],
            [ 'company_name'=>'Saphire Makeup Company',
                'workspace_id'=>$workspace_id,
                'product_id'=>1,
                'admin_id'=>$user->id,
                'name'=>'Company A',
                'email'=>'demo@example.com',
                'phone'=>'+14712345678',
                'partners'=>'Inventory (clothing, accessories).
Technology (website, mobile app, virtual try-on feature).
Relationships with suppliers and manufacturers.
Marketing and customer service teams' ,
                'activities'=>'Managing the online store (website and app).
Inventory management and supply chain coordination.
Marketing and advertising.
Customer support and relationship management.',
                'resources'=>'Inventory (clothing, accessories).
Technology (website, mobile app, virtual try-on feature).
Relationships with suppliers and manufacturers.
Marketing and customer service teams.',
                'value_propositions'=>'Exclusive designs and collaborations with local artists and designers.
Eco-friendly and ethically sourced clothing options.
Personalized shopping experience with virtual try-ons.
Competitive pricing with special discounts and loyalty programs.',
                'customer_relationships'=>'24/7 customer support (chat, email, phone).
Community engagement through social media.
Regular updates on new arrivals, sales, and special events.',
                'channels'=>'E-commerce website.
Mobile app.
Social media platforms (Instagram, Facebook, Twitter).
Email newsletters.',
                'customer_segments'=>'Young adults and fashion enthusiasts (18-35 years).
Eco-conscious consumers.
Individuals looking for unique, custom, and trendy clothing.',
                'cost_structure'=>'Inventory procurement and warehousing.
Website and app development and maintenance.
Marketing and advertising expenses.
Shipping and packaging costs.
Employee salaries and overheads.
',
                'revenue_stream'=>'Direct online sales.
Subscription boxes or membership fees.
Affiliate marketing and collaborations with influencers.',



            ],
            [ 'company_name'=>'DronesX',
                'workspace_id'=>$workspace_id,
                'product_id'=>1,
                'admin_id'=>$user->id,
                'name'=>'Company A',
                'email'=>'demo@example.com',
                'phone'=>'+14712345678',
                'partners'=>'Inventory (clothing, accessories).
Technology (website, mobile app, virtual try-on feature).
Relationships with suppliers and manufacturers.
Marketing and customer service teams' ,
                'activities'=>'Managing the online store (website and app).
Inventory management and supply chain coordination.
Marketing and advertising.
Customer support and relationship management.',
                'resources'=>'Inventory (clothing, accessories).
Technology (website, mobile app, virtual try-on feature).
Relationships with suppliers and manufacturers.
Marketing and customer service teams.',
                'value_propositions'=>'Exclusive designs and collaborations with local artists and designers.
Eco-friendly and ethically sourced clothing options.
Personalized shopping experience with virtual try-ons.
Competitive pricing with special discounts and loyalty programs.',
                'customer_relationships'=>'24/7 customer support (chat, email, phone).
Community engagement through social media.
Regular updates on new arrivals, sales, and special events.',
                'channels'=>'E-commerce website.
Mobile app.
Social media platforms (Instagram, Facebook, Twitter).
Email newsletters.',
                'customer_segments'=>'Young adults and fashion enthusiasts (18-35 years).
Eco-conscious consumers.
Individuals looking for unique, custom, and trendy clothing.',
                'cost_structure'=>'Inventory procurement and warehousing.
Website and app development and maintenance.
Marketing and advertising expenses.
Shipping and packaging costs.
Employee salaries and overheads.
',
                'revenue_stream'=>'Direct online sales.
Subscription boxes or membership fees.
Affiliate marketing and collaborations with influencers.',



            ],


            [ 'company_name'=>'Electric Car Company',
                'workspace_id'=>$workspace_id,
                'product_id'=>1,
                'admin_id'=>$user->id,
                'name'=>'Company A',
                'email'=>'demo@example.com',
                'phone'=>'+14712345678',
                'partners'=>'Inventory (clothing, accessories).
Technology (website, mobile app, virtual try-on feature).
Relationships with suppliers and manufacturers.
Marketing and customer service teams' ,
                'activities'=>'Managing the online store (website and app).
Inventory management and supply chain coordination.
Marketing and advertising.
Customer support and relationship management.',
                'resources'=>'Inventory (clothing, accessories).
Technology (website, mobile app, virtual try-on feature).
Relationships with suppliers and manufacturers.
Marketing and customer service teams.',
                'value_propositions'=>'Exclusive designs and collaborations with local artists and designers.
Eco-friendly and ethically sourced clothing options.
Personalized shopping experience with virtual try-ons.
Competitive pricing with special discounts and loyalty programs.',
                'customer_relationships'=>'24/7 customer support (chat, email, phone).
Community engagement through social media.
Regular updates on new arrivals, sales, and special events.',
                'channels'=>'E-commerce website.
Mobile app.
Social media platforms (Instagram, Facebook, Twitter).
Email newsletters.',
                'customer_segments'=>'Young adults and fashion enthusiasts (18-35 years).
Eco-conscious consumers.
Individuals looking for unique, custom, and trendy clothing.',
                'cost_structure'=>'Inventory procurement and warehousing.
Website and app development and maintenance.
Marketing and advertising expenses.
Shipping and packaging costs.
Employee salaries and overheads.
',
                'revenue_stream'=>'Direct online sales.
Subscription boxes or membership fees.
Affiliate marketing and collaborations with influencers.',



            ],


            [ 'company_name'=>'IOT Jewelry',
                'workspace_id'=>$workspace_id,
                'product_id'=>1,
                'admin_id'=>$user->id,
                'name'=>'Company A',
                'email'=>'demo@example.com',
                'phone'=>'+14712345678',
                'partners'=>'Inventory (clothing, accessories).
Technology (website, mobile app, virtual try-on feature).
Relationships with suppliers and manufacturers.
Marketing and customer service teams' ,
                'activities'=>'Managing the online store (website and app).
Inventory management and supply chain coordination.
Marketing and advertising.
Customer support and relationship management.',
                'resources'=>'Inventory (clothing, accessories).
Technology (website, mobile app, virtual try-on feature).
Relationships with suppliers and manufacturers.
Marketing and customer service teams.',
                'value_propositions'=>'Exclusive designs and collaborations with local artists and designers.
Eco-friendly and ethically sourced clothing options.
Personalized shopping experience with virtual try-ons.
Competitive pricing with special discounts and loyalty programs.',
                'customer_relationships'=>'24/7 customer support (chat, email, phone).
Community engagement through social media.
Regular updates on new arrivals, sales, and special events.',
                'channels'=>'E-commerce website.
Mobile app.
Social media platforms (Instagram, Facebook, Twitter).
Email newsletters.',
                'customer_segments'=>'Young adults and fashion enthusiasts (18-35 years).
Eco-conscious consumers.
Individuals looking for unique, custom, and trendy clothing.',
                'cost_structure'=>'Inventory procurement and warehousing.
Website and app development and maintenance.
Marketing and advertising expenses.
Shipping and packaging costs.
Employee salaries and overheads.
',
                'revenue_stream'=>'Direct online sales.
Subscription boxes or membership fees.
Affiliate marketing and collaborations with influencers.',



            ],




        ];

        foreach ($sample_business_model as $model){


            $business_model = new BusinessModel();
            $business_model->workspace_id = $workspace_id;
            $business_model->uuid = Str::uuid();
            $business_model->product_id = $model['product_id'];
            $business_model->admin_id = $model['admin_id'];
            $business_model->company_name = $model['company_name'];
            $business_model->name = $model['name'];
            $business_model->email = $model['email'];
            $business_model->phone = $model['phone'];
            $business_model->partners = $model['partners'];
            $business_model->activities = $model['activities'];
            $business_model->resources = $model['resources'];
            $business_model->value_propositions = $model['value_propositions'];
            $business_model->customer_relationships = $model['customer_relationships'];
            $business_model->channels = $model['channels'];
            $business_model->customer_segments = $model['customer_segments'];
            $business_model->cost_structure = $model['cost_structure'];
            $business_model->revenue_stream = $model['revenue_stream'];
            $business_model->save();

        }





        $sample_startup_model =[

            [ 'company_name'=>'Claire & Co.',
                'workspace_id'=>$workspace_id,
                'product_id'=>1,
                'admin_id'=>$user->id,
                'name'=>'Company A',
                'email'=>'demo@example.com',
                'phone'=>'+14712345678',
               'problems'=>'The lack of a centralized platform for managing and tracking all the different aspects of the business.',
               'solutions'=>'A web and mobile app that allows users to manage their business operations from a single platform.',
                'value_propositions'=>'A centralized platform for managing all aspects of the business.',
                'unfair_advantage'=>'First-mover advantage.',
                'customer_segments'=>'Small business owners and entrepreneurs.',
                'channels'=>'Social media platforms (Instagram, Facebook, Twitter).
Email newsletters.
',
                'cost_structure'=>'Website and app development and maintenance.',
                'key_matrices'=>'Number of users',
                'team'=>'Claire (Founder and CEO).',
                'market'=>'Small business owners and entrepreneurs.',
                'risks'=>'Competition from other similar platforms.',
                'performance'=>'Number of users.'

        ],
            [ 'company_name'=>'Scandi Decor.',
                'workspace_id'=>$workspace_id,
                'product_id'=>1,
                'admin_id'=>$user->id,
                'name'=>'Company A',
                'email'=>'demo@example.com',
                'phone'=>'+147129845678',
                'problems'=>'The lack of a centralized platform for managing and tracking all the different aspects of the business.',
                'solutions'=>'A web and mobile app that allows users to manage their business operations from a single platform.',
                'value_propositions'=>'A centralized platform for managing all aspects of the business.',
                'unfair_advantage'=>'First-mover advantage.',
                'customer_segments'=>'Small business owners and entrepreneurs.',
                'channels'=>'Social media platforms (Instagram, Facebook, Twitter).
Email newsletters.
',
                'cost_structure'=>'Website and app development and maintenance.',
                'key_matrices'=>'Number of users',
                'team'=>'Claire (Founder and CEO).',
                'market'=>'Small business owners and entrepreneurs.',
                'risks'=>'Competition from other similar platforms.',
                'performance'=>'Number of users.'

            ],
            [ 'company_name'=>'DesignForumX.',
                'workspace_id'=>$workspace_id,
                'product_id'=>1,
                'admin_id'=>$user->id,
                'name'=>'Company A',
                'email'=>'demo@example.com',
                'phone'=>'',
                'problems'=>'The lack of a centralized platform for managing and tracking all the different aspects of the business.',
                'solutions'=>'A web and mobile app that allows users to manage their business operations from a single platform.',
                'value_propositions'=>'A centralized platform for managing all aspects of the business.',
                'unfair_advantage'=>'First-mover advantage.',
                'customer_segments'=>'Small business owners and entrepreneurs.',
                'channels'=>'Social media platforms (Instagram, Facebook, Twitter).
Email newsletters.
',
                'cost_structure'=>'Website and app development and maintenance.',
                'key_matrices'=>'Number of users',
                'team'=>'Claire (Founder and CEO).',
                'market'=>'Small business owners and entrepreneurs.',
                'risks'=>'Competition from other similar platforms.',
                'performance'=>'Number of users.'

            ],
            [ 'company_name'=>'Aleya & Associates.',
                'workspace_id'=>$workspace_id,
                'product_id'=>1,
                'admin_id'=>$user->id,
                'name'=>'Company A',
                'email'=>'demo@example.com',
                'phone'=>'+27678',
                'problems'=>'The lack of a centralized platform for managing and tracking all the different aspects of the business.',
                'solutions'=>'A web and mobile app that allows users to manage their business operations from a single platform.',
                'value_propositions'=>'A centralized platform for managing all aspects of the business.',
                'unfair_advantage'=>'First-mover advantage.',
                'customer_segments'=>'Small business owners and entrepreneurs.',
                'channels'=>'Social media platforms (Instagram, Facebook, Twitter).
Email newsletters.
',
                'cost_structure'=>'Website and app development and maintenance.',
                'key_matrices'=>'Number of users',
                'team'=>'Claire (Founder and CEO).',
                'market'=>'Small business owners and entrepreneurs.',
                'risks'=>'Competition from other similar platforms.',
                'performance'=>'Number of users.'

            ],
            [ 'company_name'=>'LinkLegal.',
                'workspace_id'=>$workspace_id,
                'product_id'=>1,
                'admin_id'=>$user->id,
                'name'=>'Company A',
                'email'=>'demo@example.com',
                'phone'=>'+27678',
                'problems'=>'The lack of a centralized platform for managing and tracking all the different aspects of the business.',
                'solutions'=>'A web and mobile app that allows users to manage their business operations from a single platform.',
                'value_propositions'=>'A centralized platform for managing all aspects of the business.',
                'unfair_advantage'=>'First-mover advantage.',
                'customer_segments'=>'Small business owners and entrepreneurs.',
                'channels'=>'Social media platforms (Instagram, Facebook, Twitter).
Email newsletters.
',
                'cost_structure'=>'Website and app development and maintenance.',
                'key_matrices'=>'Number of users',
                'team'=>'Claire (Founder and CEO).',
                'market'=>'Small business owners and entrepreneurs.',
                'risks'=>'Competition from other similar platforms.',
                'performance'=>'Number of users.'

            ],
            [ 'company_name'=>'Gamex Pro.',
                'workspace_id'=>$workspace_id,
                'product_id'=>1,
                'admin_id'=>$user->id,
                'name'=>'Company A',
                'email'=>'demo@example.com',
                'phone'=>'+27678',
                'problems'=>'The lack of a centralized platform for managing and tracking all the different aspects of the business.',
                'solutions'=>'A web and mobile app that allows users to manage their business operations from a single platform.',
                'value_propositions'=>'A centralized platform for managing all aspects of the business.',
                'unfair_advantage'=>'First-mover advantage.',
                'customer_segments'=>'Small business owners and entrepreneurs.',
                'channels'=>'Social media platforms (Instagram, Facebook, Twitter).
Email newsletters.
',
                'cost_structure'=>'Website and app development and maintenance.',
                'key_matrices'=>'Number of users',
                'team'=>'Claire (Founder and CEO).',
                'market'=>'Small business owners and entrepreneurs.',
                'risks'=>'Competition from other similar platforms.',
                'performance'=>'Number of users.'

            ],
        ];

        foreach ($sample_startup_model as $model){

            $startup= new StartupCanvas();
            $startup->workspace_id = $workspace_id;
            $startup->uuid = Str::uuid();
            $startup->product_id = $model['product_id'];
            $startup->admin_id = $model['admin_id'];
            $startup->company_name = $model['company_name'];
            $startup->name = $model['name'];
            $startup->email = $model['email'];
            $startup->phone = $model['phone'];
            $startup->problems = $model['problems'];
            $startup->solutions = $model['solutions'];
            $startup->value_propositions = $model['value_propositions'];
            $startup->unfair_advantage = $model['unfair_advantage'];
            $startup->customer_segments = $model['customer_segments'];
            $startup->channels = $model['channels'];
            $startup->cost_structure = $model['cost_structure'];
            $startup->key_matrices = $model['key_matrices'];
            $startup->team = $model['team'];
            $startup->market = $model['market'];
            $startup->risks = $model['risks'];
            $startup->performance = $model['performance'];
            $startup->save();

        }


        $sample_swot= [
            [ 'company_name'=>'Techo Builders',
                'workspace_id'=>$workspace_id,
                'product_id'=>1,
                'admin_id'=>$user->id,
                'strengths'=>'Innovation and R&D: A strong focus on research and development allows the company to stay ahead of the technological curve.
Skilled Workforce: A team of talented engineers and developers dedicated to creating cutting-edge solutions.
Global Reach: Operations and clients spread across various regions, allowing for a more diversified revenue stream.
Robust Product Portfolio: Offering a wide range of products and services to cater to different market segments.',
                'weaknesses'=>'Dependency on Key Clients: A significant percentage of revenue comes from a small number of large clients, leading to potential vulnerability.
High Operating Costs: Due to the emphasis on innovation, operating costs can be quite high.
Integration Challenges: As the company grows and acquires other businesses, integration may be problematic.
Competitive Market: The tech industry is highly competitive, and staying ahead requires constant investment and innovation.',
                'opportunities'=>'Emerging Markets: There is potential for growth in emerging markets where technology adoption is on the rise.
Strategic Partnerships: Collaborating with other tech companies or related industries may open up new revenue streams.
Cloud Computing and AI Services: Expanding into these areas can help the company to align with current technological trends.
Sustainability Initiatives: Focusing on green technology and sustainable practices may enhance brand image and attract environmentally-conscious clients.',
                'threats'=>'Technological Disruption: New technologies or competitors entering the market can quickly make existing products obsolete.
Economic Fluctuations: The global economic situation might affect clients spending on technology products and services.
    Cybersecurity Risks: As a tech company, TechNova may be vulnerable to cyber-attacks, leading to potential data breaches and loss of trust.
    Regulatory Changes: Sudden changes in international laws and regulations can impact operations, especially across borders.'

            ],
            [ 'company_name'=>'Rawson Properties',
                'workspace_id'=>$workspace_id,
                'product_id'=>1,
                'admin_id'=>$user->id,
                'strengths'=>'Innovation and R&D: A strong focus on research and development allows the company to stay ahead of the technological curve.
Skilled Workforce: A team of talented engineers and developers dedicated to creating cutting-edge solutions.
Global Reach: Operations and clients spread across various regions, allowing for a more diversified revenue stream.
Robust Product Portfolio: Offering a wide range of products and services to cater to different market segments.',
                'weaknesses'=>'Dependency on Key Clients: A significant percentage of revenue comes from a small number of large clients, leading to potential vulnerability.
High Operating Costs: Due to the emphasis on innovation, operating costs can be quite high.
Integration Challenges: As the company grows and acquires other businesses, integration may be problematic.
Competitive Market: The tech industry is highly competitive, and staying ahead requires constant investment and innovation.',
                'opportunities'=>'Emerging Markets: There is potential for growth in emerging markets where technology adoption is on the rise.
Strategic Partnerships: Collaborating with other tech companies or related industries may open up new revenue streams.
Cloud Computing and AI Services: Expanding into these areas can help the company to align with current technological trends.
Sustainability Initiatives: Focusing on green technology and sustainable practices may enhance brand image and attract environmentally-conscious clients.',
                'threats'=>'Technological Disruption: New technologies or competitors entering the market can quickly make existing products obsolete.
Economic Fluctuations: The global economic situation might affect clients spending on technology products and services.
    Cybersecurity Risks: As a tech company, TechNova may be vulnerable to cyber-attacks, leading to potential data breaches and loss of trust.
    Regulatory Changes: Sudden changes in international laws and regulations can impact operations, especially across borders.'

            ],
            [ 'company_name'=>'Arizonas group',
                'workspace_id'=>$workspace_id,
                'product_id'=>1,
                'admin_id'=>$user->id,
                'strengths'=>'Innovation and R&D: A strong focus on research and development allows the company to stay ahead of the technological curve.
Skilled Workforce: A team of talented engineers and developers dedicated to creating cutting-edge solutions.
Global Reach: Operations and clients spread across various regions, allowing for a more diversified revenue stream.
Robust Product Portfolio: Offering a wide range of products and services to cater to different market segments.',
                'weaknesses'=>'Dependency on Key Clients: A significant percentage of revenue comes from a small number of large clients, leading to potential vulnerability.
High Operating Costs: Due to the emphasis on innovation, operating costs can be quite high.
Integration Challenges: As the company grows and acquires other businesses, integration may be problematic.
Competitive Market: The tech industry is highly competitive, and staying ahead requires constant investment and innovation.',
                'opportunities'=>'Emerging Markets: There is potential for growth in emerging markets where technology adoption is on the rise.
Strategic Partnerships: Collaborating with other tech companies or related industries may open up new revenue streams.
Cloud Computing and AI Services: Expanding into these areas can help the company to align with current technological trends.
Sustainability Initiatives: Focusing on green technology and sustainable practices may enhance brand image and attract environmentally-conscious clients.',
                'threats'=>'Technological Disruption: New technologies or competitors entering the market can quickly make existing products obsolete.
Economic Fluctuations: The global economic situation might affect clients spending on technology products and services.
    Cybersecurity Risks: As a tech company, TechNova may be vulnerable to cyber-attacks, leading to potential data breaches and loss of trust.
    Regulatory Changes: Sudden changes in international laws and regulations can impact operations, especially across borders.'

            ],
            [ 'company_name'=>'Health Co.',
                'workspace_id'=>$workspace_id,
                'product_id'=>1,
                'admin_id'=>$user->id,
                'strengths'=>'Innovation and R&D: A strong focus on research and development allows the company to stay ahead of the technological curve.
Skilled Workforce: A team of talented engineers and developers dedicated to creating cutting-edge solutions.
Global Reach: Operations and clients spread across various regions, allowing for a more diversified revenue stream.
Robust Product Portfolio: Offering a wide range of products and services to cater to different market segments.',
                'weaknesses'=>'Dependency on Key Clients: A significant percentage of revenue comes from a small number of large clients, leading to potential vulnerability.
High Operating Costs: Due to the emphasis on innovation, operating costs can be quite high.
Integration Challenges: As the company grows and acquires other businesses, integration may be problematic.
Competitive Market: The tech industry is highly competitive, and staying ahead requires constant investment and innovation.',
                'opportunities'=>'Emerging Markets: There is potential for growth in emerging markets where technology adoption is on the rise.
Strategic Partnerships: Collaborating with other tech companies or related industries may open up new revenue streams.
Cloud Computing and AI Services: Expanding into these areas can help the company to align with current technological trends.
Sustainability Initiatives: Focusing on green technology and sustainable practices may enhance brand image and attract environmentally-conscious clients.',
                'threats'=>'Technological Disruption: New technologies or competitors entering the market can quickly make existing products obsolete.
Economic Fluctuations: The global economic situation might affect clients spending on technology products and services.
    Cybersecurity Risks: As a tech company, TechNova may be vulnerable to cyber-attacks, leading to potential data breaches and loss of trust.
    Regulatory Changes: Sudden changes in international laws and regulations can impact operations, especially across borders.'

            ],
            [ 'company_name'=>'Deliver Direct',
                'workspace_id'=>$workspace_id,
                'product_id'=>1,
                'admin_id'=>$user->id,
                'strengths'=>'Innovation and R&D: A strong focus on research and development allows the company to stay ahead of the technological curve.
Skilled Workforce: A team of talented engineers and developers dedicated to creating cutting-edge solutions.
Global Reach: Operations and clients spread across various regions, allowing for a more diversified revenue stream.
Robust Product Portfolio: Offering a wide range of products and services to cater to different market segments.',
                'weaknesses'=>'Dependency on Key Clients: A significant percentage of revenue comes from a small number of large clients, leading to potential vulnerability.
High Operating Costs: Due to the emphasis on innovation, operating costs can be quite high.
Integration Challenges: As the company grows and acquires other businesses, integration may be problematic.
Competitive Market: The tech industry is highly competitive, and staying ahead requires constant investment and innovation.',
                'opportunities'=>'Emerging Markets: There is potential for growth in emerging markets where technology adoption is on the rise.
Strategic Partnerships: Collaborating with other tech companies or related industries may open up new revenue streams.
Cloud Computing and AI Services: Expanding into these areas can help the company to align with current technological trends.
Sustainability Initiatives: Focusing on green technology and sustainable practices may enhance brand image and attract environmentally-conscious clients.',
                'threats'=>'Technological Disruption: New technologies or competitors entering the market can quickly make existing products obsolete.
Economic Fluctuations: The global economic situation might affect clients spending on technology products and services.
    Cybersecurity Risks: As a tech company, TechNova may be vulnerable to cyber-attacks, leading to potential data breaches and loss of trust.
    Regulatory Changes: Sudden changes in international laws and regulations can impact operations, especially across borders.'

            ],
            [ 'company_name'=>'Rental Cars',
                'workspace_id'=>$workspace_id,
                'product_id'=>1,
                'admin_id'=>$user->id,
                'strengths'=>'Innovation and R&D: A strong focus on research and development allows the company to stay ahead of the technological curve.
Skilled Workforce: A team of talented engineers and developers dedicated to creating cutting-edge solutions.
Global Reach: Operations and clients spread across various regions, allowing for a more diversified revenue stream.
Robust Product Portfolio: Offering a wide range of products and services to cater to different market segments.',
                'weaknesses'=>'Dependency on Key Clients: A significant percentage of revenue comes from a small number of large clients, leading to potential vulnerability.
High Operating Costs: Due to the emphasis on innovation, operating costs can be quite high.
Integration Challenges: As the company grows and acquires other businesses, integration may be problematic.
Competitive Market: The tech industry is highly competitive, and staying ahead requires constant investment and innovation.',
                'opportunities'=>'Emerging Markets: There is potential for growth in emerging markets where technology adoption is on the rise.
Strategic Partnerships: Collaborating with other tech companies or related industries may open up new revenue streams.
Cloud Computing and AI Services: Expanding into these areas can help the company to align with current technological trends.
Sustainability Initiatives: Focusing on green technology and sustainable practices may enhance brand image and attract environmentally-conscious clients.',
                'threats'=>'Technological Disruption: New technologies or competitors entering the market can quickly make existing products obsolete.
Economic Fluctuations: The global economic situation might affect clients spending on technology products and services.
    Cybersecurity Risks: As a tech company, TechNova may be vulnerable to cyber-attacks, leading to potential data breaches and loss of trust.
    Regulatory Changes: Sudden changes in international laws and regulations can impact operations, especially across borders.'

            ],[ 'company_name'=>'Office Space',
                'workspace_id'=>$workspace_id,
                'product_id'=>1,
                'admin_id'=>$user->id,
                'strengths'=>'Innovation and R&D: A strong focus on research and development allows the company to stay ahead of the technological curve.
Skilled Workforce: A team of talented engineers and developers dedicated to creating cutting-edge solutions.
Global Reach: Operations and clients spread across various regions, allowing for a more diversified revenue stream.
Robust Product Portfolio: Offering a wide range of products and services to cater to different market segments.',
                'weaknesses'=>'Dependency on Key Clients: A significant percentage of revenue comes from a small number of large clients, leading to potential vulnerability.
High Operating Costs: Due to the emphasis on innovation, operating costs can be quite high.
Integration Challenges: As the company grows and acquires other businesses, integration may be problematic.
Competitive Market: The tech industry is highly competitive, and staying ahead requires constant investment and innovation.',
                'opportunities'=>'Emerging Markets: There is potential for growth in emerging markets where technology adoption is on the rise.
Strategic Partnerships: Collaborating with other tech companies or related industries may open up new revenue streams.
Cloud Computing and AI Services: Expanding into these areas can help the company to align with current technological trends.
Sustainability Initiatives: Focusing on green technology and sustainable practices may enhance brand image and attract environmentally-conscious clients.',
                'threats'=>'Technological Disruption: New technologies or competitors entering the market can quickly make existing products obsolete.
Economic Fluctuations: The global economic situation might affect clients spending on technology products and services.
    Cybersecurity Risks: As a tech company, TechNova may be vulnerable to cyber-attacks, leading to potential data breaches and loss of trust.
    Regulatory Changes: Sudden changes in international laws and regulations can impact operations, especially across borders.'

            ],

            ];


        foreach ($sample_swot as $swot){


                $swots = new SwotAnalysis();
                $swots->workspace_id = $workspace_id;
                $swots->uuid = Str::uuid();
                $swots->product_id = $swot['product_id'];
                $swots->admin_id = $swot['admin_id'];
                $swots->company_name = $swot['company_name'];
                $swots->strengths = $swot['strengths'];
                $swots->weaknesses = $swot['weaknesses'];
                $swots->opportunities = $swot['opportunities'];
                $swots->threats = $swot['threats'];
                $swots->save();

        }


        $sample_pest=[
            [ 'company_name'=>'TechNova',
                'workspace_id'=>$workspace_id,
                'admin_id'=>$user->id,
                'political'=>'Political stability in the country of operation. The government’s attitude towards the technology industry',
                'economic'=>'Economic growth in the country of operation. The impact of foreign exchange rates on the business',
                'social'=>'Increasing demand for technology products and services. The impact of social media on consumer behavior',
                'technological'=>'Rapid technological advancements in the industry. The impact of automation on the workforce',
            ],

            ];
                foreach ($sample_pest as $pest){

                    $pests = new PestAnalysis();
                    $pests->workspace_id = $workspace_id;
                    $pests->uuid = Str::uuid();
                    $pests->admin_id = $pest['admin_id'];
                    $pests->company_name = $pest['company_name'];
                    $pests->political = $pest['political'];
                    $pests->economic = $pest['economic'];
                    $pests->social = $pest['social'];
                    $pests->technological = $pest['technological'];
                    $pests->save();
                }



        $sample_pestel=[
            [ 'company_name'=>'TechNova',
                'workspace_id'=>$workspace_id,
                'admin_id'=>$user->id,
                'political'=>'Political stability in the country of operation. The government’s attitude towards the technology industry',
                'economic'=>'Economic growth in the country of operation. The impact of foreign exchange rates on the business',
                'social'=>'Increasing demand for technology products and services. The impact of social media on consumer behavior',
                'technological'=>'Rapid technological advancements in the industry. The impact of automation on the workforce',
                'environmental'=>'The impact of climate change on the business. The impact of environmental regulations on the business',
                'legal'=>'The impact of international trade laws on the business. The impact of data protection laws on the business',
            ],

        ];
        foreach ($sample_pestel as $pestel){

            $pests = new PestelAnalysis();
            $pests->workspace_id = $workspace_id;
            $pests->uuid = Str::uuid();
            $pests->admin_id = $pestel['admin_id'];
            $pests->company_name = $pestel['company_name'];
            $pests->political = $pestel['political'];
            $pests->economic = $pestel['economic'];
            $pests->social = $pestel['social'];
            $pests->technological = $pestel['technological'];
            $pests->environmental = $pestel['environmental'];
            $pests->legal = $pestel['legal'];
            $pests->save();
        }


        $sample_porter= [
            [ 'company_name'=>'TechNova',
                'workspace_id'=>$workspace_id,
                'admin_id'=>$user->id,
                'suppliers'=>'Supplier Power: Low supplier power due to the large number of suppliers and the availability of substitutes.',
                'entrants'=>'Buyer Power: High buyer power due to the availability of substitutes and the low switching costs.',
                'substitute'=>'Threat of Substitutes: High threat of substitutes due to the availability of alternative products and services.',
                'customers'=>'Threat of New Entrants: Low threat of new entrants due to the high capital requirements and the high level of competition.',
                'rivals'=>'Rivalry: High rivalry due to the large number of competitors and the low switching costs.',
                ],
            ];

        foreach ($sample_porter as $porter){

            $porter_analysis = new PorterModel();
            $porter_analysis->workspace_id = $workspace_id;
            $porter_analysis->uuid = Str::uuid();
            $porter_analysis->admin_id = $porter['admin_id'];
            $porter_analysis->company_name = $porter['company_name'];
            $porter_analysis->suppliers = $porter['suppliers'];
            $porter_analysis->entrants = $porter['entrants'];
            $porter_analysis->substitute = $porter['substitute'];
            $porter_analysis->customers = $porter['customers'];
            $porter_analysis->rivals = $porter['rivals'];
            $porter_analysis->save();

        }

        $sample_mckinsey=[
            [

                'company_name'=>'TechNova',
                'workspace_id'=>$workspace_id,
                'admin_id'=>1,
                'structure'=>'The struucture is very immportant for a Technology Company',
                'strategy'=>'Strategy is very important for a technology company',
                'system'=>'systems of a technology company',
                'shared_values'=>' The shared values of a technology company.Its very important to have a shared value in a company',
                'staff'=>'Staff members of a technology company has to be very good at what they do',
                'skill'=>'Skill of a technology company is determined by the staff members',
                'style'=>'Style of a technology company is determined by the staff members'



            ],
            [

                'company_name'=>'AI Models',
                'workspace_id'=>$workspace_id,
                'admin_id'=>3,
                'structure'=>'The struucture is very immportant for a Technology Company',
                'strategy'=>'Strategy is very important for a technology company',
                'system'=>'systems of a technology company',
                'shared_values'=>' The shared values of a technology company.Its very important to have a shared value in a company',
                'staff'=>'Staff members of a technology company has to be very good at what they do',
                'skill'=>'Skill of a technology company is determined by the staff members',
                'style'=>'Style of a technology company is determined by the staff members'



            ],
            [

                'company_name'=>'AutoMarket',
                'workspace_id'=>$workspace_id,
                'admin_id'=>2,
                'structure'=>'The struucture is very immportant for a Technology Company',
                'strategy'=>'Strategy is very important for a technology company',
                'system'=>'systems of a technology company',
                'shared_values'=>' The shared values of a technology company.Its very important to have a shared value in a company',
                'staff'=>'Staff members of a technology company has to be very good at what they do',
                'skill'=>'Skill of a technology company is determined by the staff members',
                'style'=>'Style of a technology company is determined by the staff members'



            ],
            [

                'company_name'=>'Orsini & Co',
                'workspace_id'=>$workspace_id,
                'admin_id'=>1,
                'structure'=>'The struucture is very immportant for a Technology Company',
                'strategy'=>'Strategy is very important for a technology company',
                'system'=>'systems of a technology company',
                'shared_values'=>' The shared values of a technology company.Its very important to have a shared value in a company',
                'staff'=>'Staff members of a technology company has to be very good at what they do',
                'skill'=>'Skill of a technology company is determined by the staff members',
                'style'=>'Style of a technology company is determined by the staff members'



            ],





        ];
        foreach ($sample_mckinsey as $model){


            $sample_business_model = new MckinseyModel();

            $sample_business_model->workspace_id = $workspace_id;
            $sample_business_model->uuid = Str::uuid();
            $sample_business_model->admin_id = $model['admin_id'];
            $sample_business_model->company_name = $model['company_name'];
            $sample_business_model->structure = $model['structure'];
            $sample_business_model->strategy = $model['strategy'];
            $sample_business_model->system = $model['system'];
            $sample_business_model->shared_values = $model['shared_values'];
            $sample_business_model->staff = $model['staff'];
            $sample_business_model->skill = $model['skill'];
            $sample_business_model->style = $model['style'];
            $sample_business_model->save();

        }



        $subscription_plans = [
            [
                'name' => 'Free',
                'price_monthly' => 4.99,
                'price_yearly' => 49.99,
                'features' => [
                    'Business Planing',
                    'Business Model Canvas',
                    'SWOT Analysis',
                    'Lean/startup Canvas',
                    'Product Planning',
                    'Ideation Canvas'
                ],

            ],
            [
                'name' => 'Premium',
                'price_monthly' => 9.99,
                'price_yearly' => 99.99,
                'features' => [
                    'Business Planing',
                    'Business Model Canvas',
                    'SWOT Analysis',
                    'Lean/startup Canvas',
                    'Product Planning',
                    'Ideation Canvas',
                    'Note Taking',
                    'Pest Analysis',
                    'Mckinsey 7S Model',
                ],

            ],
            [
                'name' => 'Basic',
                'price_monthly' => 19.99,
                'price_yearly' => 199.99,
                'features' => [

                    'Business Planing',
                    'Business Model Canvas',
                    'SWOT Analysis',
                    'Lean/startup Canvas',
                    'Product Planning',
                    'Ideation Canvas'

                ],

            ]
        ];

        foreach ($subscription_plans as $plan) {
            $subscription_plan = new SubscriptionPlan();
            $subscription_plan->name = $plan['name'];
            $subscription_plan->price_monthly = $plan['price_monthly'];
            $subscription_plan->price_yearly = $plan['price_yearly'];

            $subscription_plan->features = json_encode($plan['features']);

            $subscription_plan->save();
        }











    }}







