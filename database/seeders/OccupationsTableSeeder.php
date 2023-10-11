<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class OccupationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $occupations = [
            ['industry' => 'Software', 'occupation' => 'Software Developer'],
            ['industry' => 'Software', 'occupation' => 'Web Developer'],
            ['industry' => 'Software', 'occupation' => 'Mobile Developer'],
            ['industry' => 'Software', 'occupation' => 'DevOps Engineer'],
            ['industry' => 'Software', 'occupation' => 'QA Engineer'],
            ['industry' => 'Software', 'occupation' => 'UI/UX Designer'],
            ['industry' => 'Software', 'occupation' => 'Front-end Developer'],
            ['industry' => 'Software', 'occupation' => 'Back-end Developer'],
            ['industry' => 'Software', 'occupation' => 'Full-stack Developer'],
            ['industry' => 'Software', 'occupation' => 'Embedded Systems Developer'],
            ['industry' => 'Software', 'occupation' => 'Game Developer'],
            ['industry' => 'Software', 'occupation' => 'Database Developer'],
            ['industry' => 'Software', 'occupation' => 'Systems Engineer'],
            ['industry' => 'Software', 'occupation' => 'Application Support Engineer'],
            ['industry' => 'Software', 'occupation' => 'Technical Writer'],
            ['industry' => 'Data', 'occupation' => 'Data Analyst'],
            ['industry' => 'Data', 'occupation' => 'Data Scientist'],
            ['industry' => 'Data', 'occupation' => 'Data Engineer'],
            ['industry' => 'Data', 'occupation' => 'Database Administrator'],
            ['industry' => 'Data', 'occupation' => 'Big Data Engineer'],
            ['industry' => 'Networking', 'occupation' => 'Network Engineer'],
            ['industry' => 'Networking', 'occupation' => 'Network Administrator'],
            ['industry' => 'Networking', 'occupation' => 'Systems Administrator'],
            ['industry' => 'Networking', 'occupation' => 'Cloud Engineer'],
            ['industry' => 'Networking', 'occupation' => 'Cloud Administrator'],
            ['industry' => 'Cybersecurity', 'occupation' => 'Security Analyst'],
            ['industry' => 'Cybersecurity', 'occupation' => 'Ethical Hacker'],
            ['industry' => 'Cybersecurity', 'occupation' => 'Information Security Analyst'],
            ['industry' => 'Cybersecurity', 'occupation' => 'Security Engineer'],
            ['industry' => 'Hardware', 'occupation' => 'Hardware Engineer'],
            ['industry' => 'Hardware', 'occupation' => 'Firmware Engineer'],
            ['industry' => 'Hardware', 'occupation' => 'ASIC Design Engineer'],
            ['industry' => 'Hardware', 'occupation' => 'RF Engineer'],
            ['industry' => 'AI/ML', 'occupation' => 'Machine Learning Engineer'],
            ['industry' => 'AI/ML', 'occupation' => 'AI Research Scientist'],
            ['industry' => 'AI/ML', 'occupation' => 'NLP Engineer'],
            ['industry' => 'AI/ML', 'occupation' => 'Computer Vision Engineer'],
            ['industry' => 'Blockchain', 'occupation' => 'Blockchain Developer'],
            ['industry' => 'Blockchain', 'occupation' => 'Smart Contract Developer'],
            ['industry' => 'Blockchain', 'occupation' => 'Cryptocurrency Analyst'],

            // Sales
            ['industry' => 'Sales', 'occupation' => 'Sales Representative'],
            ['industry' => 'Sales', 'occupation' => 'Sales Engineer'],
            ['industry' => 'Sales', 'occupation' => 'Sales Manager'],
            ['industry' => 'Sales', 'occupation' => 'Account Executive'],
            ['industry' => 'Sales', 'occupation' => 'Business Development Representative'],
            ['industry' => 'Sales', 'occupation' => 'Business Development Manager'],

            // Support
            ['industry' => 'Support', 'occupation' => 'Technical Support Specialist'],
            ['industry' => 'Support', 'occupation' => 'Customer Support Representative'],
            ['industry' => 'Support', 'occupation' => 'Help Desk Technician'],
            ['industry' => 'Support', 'occupation' => 'IT Support Specialist'],
            ['industry' => 'Support', 'occupation' => 'Customer Success Manager'],

            // Project Management
            ['industry' => 'Project Management', 'occupation' => 'Project Manager'],
            ['industry' => 'Project Management', 'occupation' => 'Program Manager'],
            ['industry' => 'Project Management', 'occupation' => 'Scrum Master'],
            ['industry' => 'Project Management', 'occupation' => 'Product Manager'],
            ['industry' => 'Project Management', 'occupation' => 'Agile Coach'],

            // Human Resources
            ['industry' => 'Human Resources', 'occupation' => 'Human Resources Specialist'],
            ['industry' => 'Human Resources', 'occupation' => 'Recruiter'],
            ['industry' => 'Human Resources', 'occupation' => 'HR Manager'],
            ['industry' => 'Human Resources', 'occupation' => 'Talent Acquisition Specialist'],

            // Marketing
            ['industry' => 'Marketing', 'occupation' => 'Marketing Coordinator'],
            ['industry' => 'Marketing', 'occupation' => 'Marketing Manager'],
            ['industry' => 'Marketing', 'occupation' => 'Digital Marketing Specialist'],
            ['industry' => 'Marketing', 'occupation' => 'SEO Specialist'],
            ['industry' => 'Marketing', 'occupation' => 'Content Strategist'],

            // Finance
            ['industry' => 'Finance', 'occupation' => 'Financial Analyst'],
            ['industry' => 'Finance', 'occupation' => 'Accountant'],
            ['industry' => 'Finance', 'occupation' => 'Financial Planner'],
            ['industry' => 'Finance', 'occupation' => 'Auditor'],
            // Legal
            ['industry' => 'Legal', 'occupation' => 'Attorney'],
            ['industry' => 'Legal', 'occupation' => 'Paralegal'],
            ['industry' => 'Legal', 'occupation' => 'Legal Secretary'],
            ['industry' => 'Legal', 'occupation' => 'Legal Analyst'],
            ['industry' => 'Legal', 'occupation' => 'Compliance Officer'],

            // Healthcare
            ['industry' => 'Healthcare', 'occupation' => 'Nurse'],
            ['industry' => 'Healthcare', 'occupation' => 'Doctor'],
            ['industry' => 'Healthcare', 'occupation' => 'Pharmacist'],
            ['industry' => 'Healthcare', 'occupation' => 'Medical Technician'],
            ['industry' => 'Healthcare', 'occupation' => 'Healthcare Administrator'],

            // Education
            ['industry' => 'Education', 'occupation' => 'Teacher'],
            ['industry' => 'Education', 'occupation' => 'School Counselor'],
            ['industry' => 'Education', 'occupation' => 'Instructional Designer'],
            ['industry' => 'Education', 'occupation' => 'School Administrator'],
            ['industry' => 'Education', 'occupation' => 'Special Education Teacher'],

            // Real Estate
            ['industry' => 'Real Estate', 'occupation' => 'Real Estate Agent'],
            ['industry' => 'Real Estate', 'occupation' => 'Real Estate Broker'],
            ['industry' => 'Real Estate', 'occupation' => 'Property Manager'],
            ['industry' => 'Real Estate', 'occupation' => 'Appraiser'],

            // Manufacturing
            ['industry' => 'Manufacturing', 'occupation' => 'Production Manager'],
            ['industry' => 'Manufacturing', 'occupation' => 'Quality Assurance Manager'],
            ['industry' => 'Manufacturing', 'occupation' => 'Logistics Coordinator'],
            ['industry' => 'Manufacturing', 'occupation' => 'Supply Chain Analyst'],

            // Engineering
            ['industry' => 'Engineering', 'occupation' => 'Civil Engineer'],
            ['industry' => 'Engineering', 'occupation' => 'Mechanical Engineer'],
            ['industry' => 'Engineering', 'occupation' => 'Electrical Engineer'],
            ['industry' => 'Engineering', 'occupation' => 'Chemical Engineer'],
            ['industry' => 'Engineering', 'occupation' => 'Environmental Engineer'],

            // Research and Development
            ['industry' => 'Research and Development', 'occupation' => 'Research Scientist'],
            ['industry' => 'Research and Development', 'occupation' => 'Research Analyst'],
            ['industry' => 'Research and Development', 'occupation' => 'Product Developer'],
            ['industry' => 'Research and Development', 'occupation' => 'Laboratory Technician'],

            // Others
            ['industry' => 'Others', 'occupation' => 'Graphic Designer'],
            ['industry' => 'Others', 'occupation' => 'Event Planner'],
            ['industry' => 'Others', 'occupation' => 'Public Relations Specialist'],
            ['industry' => 'Others', 'occupation' => 'Journalist'],

            // Agriculture
            ['industry' => 'Agriculture', 'occupation' => 'Agricultural Engineer'],
            ['industry' => 'Agriculture', 'occupation' => 'Agricultural Inspector'],
            ['industry' => 'Agriculture', 'occupation' => 'Farm Manager'],
            ['industry' => 'Agriculture', 'occupation' => 'Agronomist'],

            // Art and Design
            ['industry' => 'Art and Design', 'occupation' => 'Art Director'],
            ['industry' => 'Art and Design', 'occupation' => 'Illustrator'],
            ['industry' => 'Art and Design', 'occupation' => 'Animator'],
            ['industry' => 'Art and Design', 'occupation' => 'Interior Designer'],

            // Construction
            ['industry' => 'Construction', 'occupation' => 'Construction Manager'],
            ['industry' => 'Construction', 'occupation' => 'Building Inspector'],
            ['industry' => 'Construction', 'occupation' => 'Architect'],
            ['industry' => 'Construction', 'occupation' => 'Urban Planner'],

            // Hospitality
            ['industry' => 'Hospitality', 'occupation' => 'Hotel Manager'],
            ['industry' => 'Hospitality', 'occupation' => 'Chef'],
            ['industry' => 'Hospitality', 'occupation' => 'Event Coordinator'],
            ['industry' => 'Hospitality', 'occupation' => 'Travel Agent'],

            // Transport and Logistics
            ['industry' => 'Transport and Logistics', 'occupation' => 'Logistics Manager'],
            ['industry' => 'Transport and Logistics', 'occupation' => 'Transport Planner'],
            ['industry' => 'Transport and Logistics', 'occupation' => 'Warehouse Manager'],
            ['industry' => 'Transport and Logistics', 'occupation' => 'Fleet Manager'],

            // Energy
            ['industry' => 'Energy', 'occupation' => 'Energy Analyst'],
            ['industry' => 'Energy', 'occupation' => 'Solar Energy Technician'],
            ['industry' => 'Energy', 'occupation' => 'Wind Turbine Technician'],
            ['industry' => 'Energy', 'occupation' => 'Petroleum Engineer'],

            // Environment
            ['industry' => 'Environment', 'occupation' => 'Environmental Consultant'],
            ['industry' => 'Environment', 'occupation' => 'Waste Management Officer'],
            ['industry' => 'Environment', 'occupation' => 'Recycling Coordinator'],
            ['industry' => 'Environment', 'occupation' => 'Conservation Scientist'],

            // Public Service
            ['industry' => 'Public Service', 'occupation' => 'Public Relations Officer'],
            ['industry' => 'Public Service', 'occupation' => 'Policy Analyst'],
            ['industry' => 'Public Service', 'occupation' => 'Urban Planner'],
            ['industry' => 'Public Service', 'occupation' => 'Community Outreach Coordinator'],

            // Non-Profit
            ['industry' => 'Non-Profit', 'occupation' => 'Fundraising Coordinator'],
            ['industry' => 'Non-Profit', 'occupation' => 'Volunteer Coordinator'],
            ['industry' => 'Non-Profit', 'occupation' => 'Program Director'],
            ['industry' => 'Non-Profit', 'occupation' => 'Grant Writer'],
            // Automotive
            ['industry' => 'Automotive', 'occupation' => 'Automotive Technician'],
            ['industry' => 'Automotive', 'occupation' => 'Automotive Engineer'],
            ['industry' => 'Automotive', 'occupation' => 'Auto Body Technician'],
            ['industry' => 'Automotive', 'occupation' => 'Service Advisor'],

            // Aviation
            ['industry' => 'Aviation', 'occupation' => 'Pilot'],
            ['industry' => 'Aviation', 'occupation' => 'Air Traffic Controller'],
            ['industry' => 'Aviation', 'occupation' => 'Aerospace Engineer'],
            ['industry' => 'Aviation', 'occupation' => 'Aircraft Mechanic'],

            // Retail
            ['industry' => 'Retail', 'occupation' => 'Retail Manager'],
            ['industry' => 'Retail', 'occupation' => 'Store Associate'],
            ['industry' => 'Retail', 'occupation' => 'Merchandiser'],
            ['industry' => 'Retail', 'occupation' => 'Buyer'],

            // Entertainment
            ['industry' => 'Entertainment', 'occupation' => 'Actor'],
            ['industry' => 'Entertainment', 'occupation' => 'Musician'],
            ['industry' => 'Entertainment', 'occupation' => 'Talent Agent'],
            ['industry' => 'Entertainment', 'occupation' => 'Film Editor'],

            // Sports
            ['industry' => 'Sports', 'occupation' => 'Athlete'],
            ['industry' => 'Sports', 'occupation' => 'Coach'],
            ['industry' => 'Sports', 'occupation' => 'Sports Analyst'],
            ['industry' => 'Sports', 'occupation' => 'Physical Therapist'],

            // Insurance
            ['industry' => 'Insurance', 'occupation' => 'Insurance Agent'],
            ['industry' => 'Insurance', 'occupation' => 'Claims Adjuster'],
            ['industry' => 'Insurance', 'occupation' => 'Underwriter'],
            ['industry' => 'Insurance', 'occupation' => 'Actuary'],

            // Food and Beverage
            ['industry' => 'Food and Beverage', 'occupation' => 'Chef'],
            ['industry' => 'Food and Beverage', 'occupation' => 'Food Scientist'],
            ['industry' => 'Food and Beverage', 'occupation' => 'Brewmaster'],
            ['industry' => 'Food and Beverage', 'occupation' => 'Dietitian'],

            // Social Work
            ['industry' => 'Social Work', 'occupation' => 'Clinical Social Worker'],
            ['industry' => 'Social Work', 'occupation' => 'School Social Worker'],
            ['industry' => 'Social Work', 'occupation' => 'Mental Health Counselor'],
            ['industry' => 'Social Work', 'occupation' => 'Substance Abuse Counselor'],

            // Government
            ['industry' => 'Government', 'occupation' => 'Legislative Aide'],
            ['industry' => 'Government', 'occupation' => 'City Planner'],
            ['industry' => 'Government', 'occupation' => 'Public Affairs Specialist'],
            ['industry' => 'Government', 'occupation' => 'Customs Officer'],

            // Military
            ['industry' => 'Military', 'occupation' => 'Military Officer'],
            ['industry' => 'Military', 'occupation' => 'Enlisted Soldier'],
            ['industry' => 'Military', 'occupation' => 'Military Analyst'],
            ['industry' => 'Military', 'occupation' => 'Logistics Specialist'],
        ];

        DB::table('occupations')->insert($occupations);
    }
}
