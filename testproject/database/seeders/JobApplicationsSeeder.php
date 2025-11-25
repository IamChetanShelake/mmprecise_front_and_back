<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JobApplication;

class JobApplicationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $applications = [
            [
                'full_name' => 'John Smith',
                'email' => 'john.smith@email.com',
                'phone_number' => '+1-555-0123',
                'current_location' => 'New York, NY',
                'applied_role' => 'Senior Software Engineer',
                'cover_letter' => 'I am excited to apply for the Senior Software Engineer position at your company. With over 5 years of experience in full-stack development, I believe I would be a valuable addition to your team.',
                'status' => 'pending',
                'admin_notes' => null,
                'created_at' => now()->subDays(3),
            ],
            [
                'full_name' => 'Sarah Johnson',
                'email' => 'sarah.johnson@email.com',
                'phone_number' => '+1-555-0456',
                'current_location' => 'San Francisco, CA',
                'applied_role' => 'UX/UI Designer',
                'cover_letter' => 'As a passionate UX/UI designer with 4 years of experience creating user-centered designs, I am thrilled to apply for this position. I have a strong background in user research and prototyping.',
                'status' => 'reviewed',
                'admin_notes' => 'Strong portfolio, good communication skills. Schedule interview.',
                'reviewed_at' => now()->subDays(1),
                'created_at' => now()->subDays(5),
            ],
            [
                'full_name' => 'Michael Chen',
                'email' => 'michael.chen@email.com',
                'phone_number' => '+1-555-0789',
                'current_location' => 'Austin, TX',
                'applied_role' => 'Project Manager',
                'cover_letter' => 'With 6 years of experience managing software development projects and a PMP certification, I am confident in my ability to lead your team to successful project deliveries.',
                'status' => 'shortlisted',
                'admin_notes' => 'Excellent experience, PMP certified. Move to final interview round.',
                'reviewed_at' => now()->subDays(2),
                'created_at' => now()->subDays(7),
            ],
            [
                'full_name' => 'Emily Davis',
                'email' => 'emily.davis@email.com',
                'phone_number' => '+1-555-0321',
                'current_location' => 'Chicago, IL',
                'applied_role' => 'Marketing Manager',
                'cover_letter' => 'I bring 4 years of digital marketing experience and a proven track record of increasing brand awareness and lead generation. I am excited about this opportunity.',
                'status' => 'rejected',
                'admin_notes' => 'Good experience but not enough focus on B2B marketing. Position requires more technical marketing knowledge.',
                'reviewed_at' => now()->subDays(1),
                'created_at' => now()->subDays(4),
            ],
            [
                'full_name' => 'David Wilson',
                'email' => 'david.wilson@email.com',
                'phone_number' => '+1-555-0654',
                'current_location' => 'Seattle, WA',
                'applied_role' => 'DevOps Engineer',
                'cover_letter' => 'With extensive experience in cloud infrastructure, CI/CD pipelines, and containerization technologies, I am well-equipped to handle your DevOps needs.',
                'status' => 'hired',
                'admin_notes' => 'Perfect fit for the role. Extensive AWS experience. Offer extended and accepted.',
                'reviewed_at' => now()->subDays(3),
                'created_at' => now()->subDays(10),
            ],
            [
                'full_name' => 'Lisa Rodriguez',
                'email' => 'lisa.rodriguez@email.com',
                'phone_number' => '+1-555-0987',
                'current_location' => 'Miami, FL',
                'applied_role' => 'Data Analyst',
                'cover_letter' => 'My background in data analysis, statistical modeling, and business intelligence makes me an ideal candidate for this position. I am proficient in SQL, Python, and various BI tools.',
                'status' => 'pending',
                'admin_notes' => null,
                'created_at' => now()->subDays(1),
            ],
            [
                'full_name' => 'Robert Kim',
                'email' => 'robert.kim@email.com',
                'phone_number' => '+1-555-0432',
                'current_location' => 'Los Angeles, CA',
                'applied_role' => 'Full Stack Developer',
                'cover_letter' => 'I am a full-stack developer with 3 years of experience building web applications using modern technologies. I am particularly interested in your company\'s innovative approach to software development.',
                'status' => 'reviewed',
                'admin_notes' => 'Good technical skills, needs to improve communication. Consider for junior role.',
                'reviewed_at' => now()->subDays(1),
                'created_at' => now()->subDays(6),
            ],
            [
                'full_name' => 'Jennifer Brown',
                'email' => 'jennifer.brown@email.com',
                'phone_number' => '+1-555-0765',
                'current_location' => 'Boston, MA',
                'applied_role' => 'HR Manager',
                'cover_letter' => 'With 7 years of HR experience including recruitment, employee relations, and talent development, I am excited to bring my expertise to your growing team.',
                'status' => 'shortlisted',
                'admin_notes' => 'Strong HR background, good cultural fit. Schedule final interview.',
                'reviewed_at' => now()->subDays(2),
                'created_at' => now()->subDays(8),
            ],
        ];

        foreach ($applications as $application) {
            JobApplication::create($application);
        }
    }
}
