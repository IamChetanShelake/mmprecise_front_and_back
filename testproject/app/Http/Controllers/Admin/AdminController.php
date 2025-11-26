<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hero;
use App\Models\About;
use App\Models\CompanyOverview;
use App\Models\Leadership;
use App\Models\Team;
use App\Models\Achievement;
use App\Models\ClientFeedback;
use App\Models\Partner;
use App\Models\WhyChoose;
use App\Models\FeaturedHighlight;
use App\Models\LatestNews;
use App\Models\BusinessHours;
use App\Models\Career;
use App\Models\JobApplication;
use App\Models\Mentorship;
use App\Models\Expertise;
use App\Models\TechnicalSpecialization;
use App\Models\Certification;
use App\Models\Membership;
use App\Models\GetInTouch;
use App\Models\Project;
use App\Models\ProjectFeature;
use App\Models\ProjectGallery;
use App\Models\ProjectAchievement;
use App\Models\ProjectStrengthResult;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.home.home', ['activeSection' => 'home']);
    }

    public function home()
    {
        return view('admin.home.home', ['activeSection' => 'home']);
    }

    public function about()
    {
        $about = About::first(); // Get the first (and only) about
        return view('admin.about.about', compact('about'), ['activeSection' => 'about']);
    }

    public function createAbout()
    {
        return view('admin.about.create', ['activeSection' => 'about']);
    }

    public function storeAbout(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'first_description' => 'required|string',
            'second_description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:5120', // 5MB limit
            'projects_count' => 'required|integer|min:0',
            'years_count' => 'required|integer|min:0',
            'workforce_count' => 'required|integer|min:0',
            'tonnes_saved' => 'required|integer|min:0',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/abouts'), $imageName);
            $data['image'] = 'images/abouts/' . $imageName;
        }

        About::create($data);

        return redirect()->route('admin.about')->with('success', 'About section created successfully.');
    }

    public function editAbout($id)
    {
        $about = About::findOrFail($id);
        return view('admin.about.edit', compact('about'), ['activeSection' => 'about']);
    }

    public function updateAbout(Request $request, $id)
    {
        $about = About::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'first_description' => 'required|string',
            'second_description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:5120', // 5MB limit
            'projects_count' => 'required|integer|min:0',
            'years_count' => 'required|integer|min:0',
            'workforce_count' => 'required|integer|min:0',
            'tonnes_saved' => 'required|integer|min:0',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            // Delete old image
            if ($about->image && file_exists(public_path($about->image))) {
                unlink(public_path($about->image));
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/abouts'), $imageName);
            $data['image'] = 'images/abouts/' . $imageName;
        }

        $about->update($data);

        return redirect()->route('admin.about')->with('success', 'About section updated successfully.');
    }

    public function destroyAbout($id)
    {
        $about = About::findOrFail($id);

        // Delete image file
        if ($about->image && file_exists(public_path($about->image))) {
            unlink(public_path($about->image));
        }

        $about->delete();

        return redirect()->route('admin.about')->with('success', 'About section deleted successfully.');
    }

    public function toggleAboutStatus($id)
    {
        $about = About::findOrFail($id);
        $about->update(['is_active' => !$about->is_active]);

        return redirect()->route('admin.about')->with('success', 'About status updated successfully.');
    }

    public function expertise()
    {
        $expertise = Expertise::first(); // Get the first (and only) expertise entry
        return view('admin.expertise.expertise', compact('expertise'), ['activeSection' => 'expertise']);
    }

    public function createExpertise()
    {
        return view('admin.expertise.create', ['activeSection' => 'expertise']);
    }

    public function storeExpertise(Request $request)
    {
        $request->validate([
            'main_title' => 'nullable|string|max:255',
            'main_description' => 'nullable|string',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:5120',
            'second_title' => 'nullable|string|max:255',
            'second_points' => 'nullable|array',
            'second_points.*' => 'nullable|string|max:500',
            'second_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:5120',
            'third_title' => 'nullable|string|max:255',
            'third_points' => 'nullable|array',
            'third_points.*' => 'nullable|string|max:500',
            'third_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:5120',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();

        // Handle points arrays - filter out empty values
        if (isset($data['second_points'])) {
            $data['second_points'] = array_filter($data['second_points'], function($value) {
                return !empty(trim($value));
            });
        }

        if (isset($data['third_points'])) {
            $data['third_points'] = array_filter($data['third_points'], function($value) {
                return !empty(trim($value));
            });
        }

        // Handle image uploads
        $imageFields = ['main_image', 'second_image', 'third_image'];
        foreach ($imageFields as $field) {
            if ($request->hasFile($field)) {
                $imageName = time() . '_' . $field . '.' . $request->file($field)->extension();
                $request->file($field)->move(public_path('images/expertises'), $imageName);
                $data[$field] = 'images/expertises/' . $imageName;
            }
        }

        Expertise::create($data);

        return redirect()->route('admin.expertise')->with('success', 'Expertise section created successfully.');
    }

    public function editExpertise($id)
    {
        $expertise = Expertise::findOrFail($id);
        return view('admin.expertise.edit', compact('expertise'), ['activeSection' => 'expertise']);
    }

    public function updateExpertise(Request $request, $id)
    {
        $expertise = Expertise::findOrFail($id);

        $request->validate([
            'main_title' => 'nullable|string|max:255',
            'main_description' => 'nullable|string',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:5120',
            'second_title' => 'nullable|string|max:255',
            'second_points' => 'nullable|array',
            'second_points.*' => 'nullable|string|max:500',
            'second_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:5120',
            'third_title' => 'nullable|string|max:255',
            'third_points' => 'nullable|array',
            'third_points.*' => 'nullable|string|max:500',
            'third_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:5120',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();

        // Handle points arrays - filter out empty values
        if (isset($data['second_points'])) {
            $data['second_points'] = array_filter($data['second_points'], function($value) {
                return !empty(trim($value));
            });
        }

        if (isset($data['third_points'])) {
            $data['third_points'] = array_filter($data['third_points'], function($value) {
                return !empty(trim($value));
            });
        }

        // Handle image uploads
        $imageFields = ['main_image', 'second_image', 'third_image'];
        foreach ($imageFields as $field) {
            if ($request->hasFile($field)) {
                // Delete old image
                if ($expertise->$field && file_exists(public_path($expertise->$field))) {
                    unlink(public_path($expertise->$field));
                }

                $imageName = time() . '_' . $field . '.' . $request->file($field)->extension();
                $request->file($field)->move(public_path('images/expertises'), $imageName);
                $data[$field] = 'images/expertises/' . $imageName;
            }
        }

        $expertise->update($data);

        return redirect()->route('admin.expertise')->with('success', 'Expertise section updated successfully.');
    }

    public function destroyExpertise($id)
    {
        $expertise = Expertise::findOrFail($id);

        // Delete images
        $imageFields = ['main_image', 'second_image', 'third_image'];
        foreach ($imageFields as $field) {
            if ($expertise->$field && file_exists(public_path($expertise->$field))) {
                unlink(public_path($expertise->$field));
            }
        }

        $expertise->delete();

        return redirect()->route('admin.expertise')->with('success', 'Expertise section deleted successfully.');
    }

    public function toggleExpertiseStatus($id)
    {
        $expertise = Expertise::findOrFail($id);
        $expertise->update(['is_active' => !$expertise->is_active]);

        return redirect()->route('admin.expertise')->with('success', 'Expertise status updated successfully.');
    }

    // Projects CRUD
    public function projects()
    {
        $projects = Project::with(['features', 'galleries', 'achievements', 'strengthResults'])
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.projects.index', compact('projects'), ['activeSection' => 'projects']);
    }

    public function createProject()
    {
        return view('admin.projects.create', ['activeSection' => 'projects']);
    }

    public function storeProject(Request $request)
    {
        $request->validate([
            'type' => 'required|in:ongoing,completed',
            'main_image' => 'required|image|mimes:jpeg,png,jpg,gif,webp,svg|max:5120',
            'title' => 'required|string|max:255',
            'span' => 'nullable|string|max:255',
            'area' => 'nullable|string|max:255',
            'technology' => 'nullable|string|max:255',
            'completion' => 'nullable|string|max:255',
            'features' => 'nullable|array',
            'features.*' => 'nullable|string',
            'gallery_images' => 'nullable|array',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:5120',
            'achievement_titles' => 'nullable|array',
            'achievement_titles.*' => 'nullable|string|max:255',
            'achievement_descriptions' => 'nullable|array',
            'achievement_descriptions.*' => 'nullable|string',
            'achievement_photos' => 'nullable|array',
            'achievement_photos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:5120',
            'strength_titles' => 'nullable|array',
            'strength_titles.*' => 'nullable|string|max:255',
            'strength_descriptions' => 'nullable|array',
            'strength_descriptions.*' => 'nullable|string',
            'status' => 'boolean'
        ]);

        // Handle main image upload
        $mainImagePath = null;
        if ($request->hasFile('main_image')) {
            $imageName = time() . '_main.' . $request->main_image->extension();
            $request->main_image->move(public_path('images/projects'), $imageName);
            $mainImagePath = 'images/projects/' . $imageName;
        }

        // Create project
        $project = Project::create([
            'type' => $request->type,
            'main_image' => $mainImagePath,
            'title' => $request->title,
            'span' => $request->span,
            'area' => $request->area,
            'technology' => $request->technology,
            'completion' => $request->completion,
            'status' => $request->has('status') ? true : false
        ]);

        // Store features
        if ($request->has('features')) {
            foreach ($request->features as $index => $feature) {
                if (!empty(trim($feature))) {
                    ProjectFeature::create([
                        'project_id' => $project->id,
                        'feature' => $feature,
                        'order' => $index
                    ]);
                }
            }
        }

        // Store gallery images
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $index => $image) {
                $imageName = time() . '_gallery_' . $index . '.' . $image->extension();
                $image->move(public_path('images/projects/gallery'), $imageName);
                
                ProjectGallery::create([
                    'project_id' => $project->id,
                    'image' => 'images/projects/gallery/' . $imageName,
                    'order' => $index
                ]);
            }
        }

        // Store achievements
        if ($request->has('achievement_titles')) {
            foreach ($request->achievement_titles as $index => $title) {
                if (!empty(trim($title))) {
                    $photoPath = null;
                    if ($request->hasFile("achievement_photos.$index")) {
                        $imageName = time() . '_achievement_' . $index . '.' . $request->file("achievement_photos.$index")->extension();
                        $request->file("achievement_photos.$index")->move(public_path('images/projects/achievements'), $imageName);
                        $photoPath = 'images/projects/achievements/' . $imageName;
                    }

                    ProjectAchievement::create([
                        'project_id' => $project->id,
                        'title' => $title,
                        'description' => $request->achievement_descriptions[$index] ?? '',
                        'photo' => $photoPath,
                        'order' => $index
                    ]);
                }
            }
        }

        // Store strength results
        if ($request->has('strength_titles')) {
            foreach ($request->strength_titles as $index => $title) {
                if (!empty(trim($title))) {
                    ProjectStrengthResult::create([
                        'project_id' => $project->id,
                        'title' => $title,
                        'description' => $request->strength_descriptions[$index] ?? '',
                        'order' => $index
                    ]);
                }
            }
        }

        return redirect()->route('admin.projects')->with('success', 'Project created successfully.');
    }

    public function editProject($id)
    {
        $project = Project::with(['features', 'galleries', 'achievements', 'strengthResults'])->findOrFail($id);
        return view('admin.projects.edit', compact('project'), ['activeSection' => 'projects']);
    }

    public function updateProject(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        $request->validate([
            'type' => 'required|in:ongoing,completed',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:5120',
            'title' => 'required|string|max:255',
            'span' => 'nullable|string|max:255',
            'area' => 'nullable|string|max:255',
            'technology' => 'nullable|string|max:255',
            'completion' => 'nullable|string|max:255',
            'features' => 'nullable|array',
            'features.*' => 'nullable|string',
            'gallery_images' => 'nullable|array',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:5120',
            'achievement_titles' => 'nullable|array',
            'achievement_titles.*' => 'nullable|string|max:255',
            'achievement_descriptions' => 'nullable|array',
            'achievement_descriptions.*' => 'nullable|string',
            'achievement_photos' => 'nullable|array',
            'achievement_photos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:5120',
            'strength_titles' => 'nullable|array',
            'strength_titles.*' => 'nullable|string|max:255',
            'strength_descriptions' => 'nullable|array',
            'strength_descriptions.*' => 'nullable|string',
            'status' => 'boolean'
        ]);

        // Handle main image upload
        if ($request->hasFile('main_image')) {
            // Delete old image
            if ($project->main_image && file_exists(public_path($project->main_image))) {
                unlink(public_path($project->main_image));
            }

            $imageName = time() . '_main.' . $request->main_image->extension();
            $request->main_image->move(public_path('images/projects'), $imageName);
            $project->main_image = 'images/projects/' . $imageName;
        }

        // Update project
        $project->update([
            'type' => $request->type,
            'main_image' => $project->main_image,
            'title' => $request->title,
            'span' => $request->span,
            'area' => $request->area,
            'technology' => $request->technology,
            'completion' => $request->completion,
            'status' => $request->has('status') ? true : false
        ]);

        // Update features - delete old and create new
        $project->features()->delete();
        if ($request->has('features')) {
            foreach ($request->features as $index => $feature) {
                if (!empty(trim($feature))) {
                    ProjectFeature::create([
                        'project_id' => $project->id,
                        'feature' => $feature,
                        'order' => $index
                    ]);
                }
            }
        }

        // Update gallery images
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $index => $image) {
                $imageName = time() . '_gallery_' . $index . '.' . $image->extension();
                $image->move(public_path('images/projects/gallery'), $imageName);
                
                ProjectGallery::create([
                    'project_id' => $project->id,
                    'image' => 'images/projects/gallery/' . $imageName,
                    'order' => $index
                ]);
            }
        }

        // Update achievements - delete old and create new
        foreach ($project->achievements as $achievement) {
            if ($achievement->photo && file_exists(public_path($achievement->photo))) {
                unlink(public_path($achievement->photo));
            }
        }
        $project->achievements()->delete();

        if ($request->has('achievement_titles')) {
            foreach ($request->achievement_titles as $index => $title) {
                if (!empty(trim($title))) {
                    $photoPath = null;
                    if ($request->hasFile("achievement_photos.$index")) {
                        $imageName = time() . '_achievement_' . $index . '.' . $request->file("achievement_photos.$index")->extension();
                        $request->file("achievement_photos.$index")->move(public_path('images/projects/achievements'), $imageName);
                        $photoPath = 'images/projects/achievements/' . $imageName;
                    }

                    ProjectAchievement::create([
                        'project_id' => $project->id,
                        'title' => $title,
                        'description' => $request->achievement_descriptions[$index] ?? '',
                        'photo' => $photoPath,
                        'order' => $index
                    ]);
                }
            }
        }

        // Update strength results - delete old and create new
        $project->strengthResults()->delete();
        if ($request->has('strength_titles')) {
            foreach ($request->strength_titles as $index => $title) {
                if (!empty(trim($title))) {
                    ProjectStrengthResult::create([
                        'project_id' => $project->id,
                        'title' => $title,
                        'description' => $request->strength_descriptions[$index] ?? '',
                        'order' => $index
                    ]);
                }
            }
        }

        return redirect()->route('admin.projects')->with('success', 'Project updated successfully.');
    }

    public function destroyProject($id)
    {
        $project = Project::findOrFail($id);

        // Delete main image
        if ($project->main_image && file_exists(public_path($project->main_image))) {
            unlink(public_path($project->main_image));
        }

        // Delete gallery images
        foreach ($project->galleries as $gallery) {
            if ($gallery->image && file_exists(public_path($gallery->image))) {
                unlink(public_path($gallery->image));
            }
        }

        // Delete achievement photos
        foreach ($project->achievements as $achievement) {
            if ($achievement->photo && file_exists(public_path($achievement->photo))) {
                unlink(public_path($achievement->photo));
            }
        }

        // Delete project (cascade will handle related records)
        $project->delete();

        return redirect()->route('admin.projects')->with('success', 'Project deleted successfully.');
    }

    public function toggleProjectStatus($id)
    {
        $project = Project::findOrFail($id);
        $project->update(['status' => !$project->status]);

        return redirect()->route('admin.projects')->with('success', 'Project status updated successfully.');
    }

    public function csr()
    {
        return view('admin.csr.csr', ['activeSection' => 'csr']);
    }

    public function careers()
    {
        $careers = Career::orderBy('sort_order')->orderBy('created_at', 'desc')->get();
        return view('admin.careers.careers', compact('careers'), ['activeSection' => 'careers']);
    }

    public function createCareer()
    {
        return view('admin.careers.create', ['activeSection' => 'careers']);
    }

    public function storeCareer(Request $request)
    {
        $request->validate([
            'role' => 'required|string|max:255',
            'skills' => 'nullable|array',
            'skills.*' => 'nullable|string|max:255',
            'responsibilities' => 'nullable|string',
            'location' => 'required|string|max:255',
            'years_experience' => 'required|string|max:100',
            'is_active' => 'boolean',
            'sort_order' => 'integer'
        ]);

        $data = $request->all();

        // Filter out empty skills
        if (isset($data['skills'])) {
            $data['skills'] = array_filter($data['skills'], function($skill) {
                return !empty(trim($skill));
            });
        }

        Career::create($data);

        return redirect()->route('admin.careers')->with('success', 'Career opening created successfully.');
    }

    public function editCareer($id)
    {
        $career = Career::findOrFail($id);
        return view('admin.careers.edit', compact('career'), ['activeSection' => 'careers']);
    }

    public function updateCareer(Request $request, $id)
    {
        $career = Career::findOrFail($id);

        $request->validate([
            'role' => 'required|string|max:255',
            'skills' => 'nullable|array',
            'skills.*' => 'nullable|string|max:255',
            'responsibilities' => 'nullable|string',
            'location' => 'required|string|max:255',
            'years_experience' => 'required|string|max:100',
            'is_active' => 'boolean',
            'sort_order' => 'integer'
        ]);

        $data = $request->all();

        // Filter out empty skills
        if (isset($data['skills'])) {
            $data['skills'] = array_filter($data['skills'], function($skill) {
                return !empty(trim($skill));
            });
        }

        $career->update($data);

        return redirect()->route('admin.careers')->with('success', 'Career opening updated successfully.');
    }

    public function destroyCareer($id)
    {
        $career = Career::findOrFail($id);
        $career->delete();

        return redirect()->route('admin.careers')->with('success', 'Career opening deleted successfully.');
    }

    public function toggleCareerStatus($id)
    {
        $career = Career::findOrFail($id);
        $career->update(['is_active' => !$career->is_active]);

        return redirect()->route('admin.careers')->with('success', 'Career status updated successfully.');
    }

    public function contact()
    {
        return view('admin.contact.contact', ['activeSection' => 'contact']);
    }

    public function achievements()
    {
        $achievements = Achievement::orderBy('sort_order')->orderBy('created_at', 'desc')->get();
        return view('admin.achievements.achievements', compact('achievements'), ['activeSection' => 'achievements']);
    }

    public function createAchievement()
    {
        return view('admin.achievements.create', ['activeSection' => 'achievements']);
    }

    public function storeAchievement(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:5120', // 5MB limit
            'sort_order' => 'integer',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/achievements'), $imageName);
            $data['image'] = 'images/achievements/' . $imageName;
        }

        Achievement::create($data);

        return redirect()->route('admin.achievements')->with('success', 'Achievement created successfully.');
    }

    public function editAchievement($id)
    {
        $achievement = Achievement::findOrFail($id);
        return view('admin.achievements.edit', compact('achievement'), ['activeSection' => 'achievements']);
    }

    public function updateAchievement(Request $request, $id)
    {
        $achievement = Achievement::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:5120', // 5MB limit
            'sort_order' => 'integer',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            // Delete old image
            if ($achievement->image && file_exists(public_path($achievement->image))) {
                unlink(public_path($achievement->image));
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/achievements'), $imageName);
            $data['image'] = 'images/achievements/' . $imageName;
        }

        $achievement->update($data);

        return redirect()->route('admin.achievements')->with('success', 'Achievement updated successfully.');
    }

    public function destroyAchievement($id)
    {
        $achievement = Achievement::findOrFail($id);

        // Delete image file
        if ($achievement->image && file_exists(public_path($achievement->image))) {
            unlink(public_path($achievement->image));
        }

        $achievement->delete();

        return redirect()->route('admin.achievements')->with('success', 'Achievement deleted successfully.');
    }

    public function toggleAchievementStatus($id)
    {
        $achievement = Achievement::findOrFail($id);
        $achievement->update(['is_active' => !$achievement->is_active]);

        return redirect()->route('admin.achievements')->with('success', 'Achievement status updated successfully.');
    }

    public function hero()
    {
        $hero = Hero::first(); // Get the first (and only) hero
        return view('admin.hero.hero', compact('hero'), ['activeSection' => 'hero']);
    }

    public function createHero()
    {
        return view('admin.hero.create', ['activeSection' => 'hero']);
    }

    public function storeHero(Request $request)
    {
        $request->validate([
            'first_title' => 'required|string|max:255',
            'second_title' => 'required|string|max:255',
            'description' => 'required|string',
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();

        if ($request->hasFile('background_image')) {
            $imageName = time() . '.' . $request->background_image->extension();
            $request->background_image->move(public_path('images/heroes'), $imageName);
            $data['background_image'] = 'images/heroes/' . $imageName;
        }

        Hero::create($data);

        return redirect()->route('admin.hero')->with('success', 'Hero section created successfully.');
    }

    public function editHero($id)
    {
        $hero = Hero::findOrFail($id);
        return view('admin.hero.edit', compact('hero'), ['activeSection' => 'hero']);
    }

    public function updateHero(Request $request, $id)
    {
        $hero = Hero::findOrFail($id);

        $request->validate([
            'first_title' => 'required|string|max:255',
            'second_title' => 'required|string|max:255',
            'description' => 'required|string',
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();

        if ($request->hasFile('background_image')) {
            // Delete old image
            if ($hero->background_image && file_exists(public_path($hero->background_image))) {
                unlink(public_path($hero->background_image));
            }

            $imageName = time() . '.' . $request->background_image->extension();
            $request->background_image->move(public_path('images/heroes'), $imageName);
            $data['background_image'] = 'images/heroes/' . $imageName;
        }

        $hero->update($data);

        return redirect()->route('admin.hero')->with('success', 'Hero section updated successfully.');
    }

    public function destroyHero($id)
    {
        $hero = Hero::findOrFail($id);

        // Delete image file
        if ($hero->background_image && file_exists(public_path($hero->background_image))) {
            unlink(public_path($hero->background_image));
        }

        $hero->delete();

        return redirect()->route('admin.hero')->with('success', 'Hero section deleted successfully.');
    }

    public function toggleHeroStatus($id)
    {
        $hero = Hero::findOrFail($id);
        $hero->update(['is_active' => !$hero->is_active]);

        return redirect()->route('admin.hero')->with('success', 'Hero status updated successfully.');
    }

    public function companyOverview()
    {
        $companyOverview = CompanyOverview::first(); // Get the first (and only) company overview
        return view('admin.company-overview.company-overview', compact('companyOverview'), ['activeSection' => 'company-overview']);
    }

    public function createCompanyOverview()
    {
        return view('admin.company-overview.create', ['activeSection' => 'company-overview']);
    }

    public function storeCompanyOverview(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'first_description' => 'required|string',
            'second_description' => 'required|string',
            'years_experience' => 'required|integer|min:0',
            'projects_completed' => 'required|integer|min:0',
            'expert_engineers' => 'required|integer|min:0',
            'vision_description' => 'required|string',
            'mission_points' => 'nullable|array',
            'mission_points.*' => 'nullable|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:5120', // 5MB limit
            'is_active' => 'boolean'
        ]);

        $data = $request->all();

        // Handle mission points - filter out empty values
        if (isset($data['mission_points'])) {
            $data['mission_points'] = array_filter($data['mission_points'], function($value) {
                return !empty(trim($value));
            });
        }

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/company-overviews'), $imageName);
            $data['image'] = 'images/company-overviews/' . $imageName;
        }

        CompanyOverview::create($data);

        return redirect()->route('admin.company-overview')->with('success', 'Company Overview section created successfully.');
    }

    public function editCompanyOverview($id)
    {
        $companyOverview = CompanyOverview::findOrFail($id);
        return view('admin.company-overview.edit', compact('companyOverview'), ['activeSection' => 'company-overview']);
    }

    public function updateCompanyOverview(Request $request, $id)
    {
        $companyOverview = CompanyOverview::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'first_description' => 'required|string',
            'second_description' => 'required|string',
            'years_experience' => 'required|integer|min:0',
            'projects_completed' => 'required|integer|min:0',
            'expert_engineers' => 'required|integer|min:0',
            'vision_description' => 'required|string',
            'mission_points' => 'nullable|array',
            'mission_points.*' => 'nullable|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:5120', // 5MB limit
            'is_active' => 'boolean'
        ]);

        $data = $request->all();

        // Handle mission points - filter out empty values
        if (isset($data['mission_points'])) {
            $data['mission_points'] = array_filter($data['mission_points'], function($value) {
                return !empty(trim($value));
            });
        }

        if ($request->hasFile('image')) {
            // Delete old image
            if ($companyOverview->image && file_exists(public_path($companyOverview->image))) {
                unlink(public_path($companyOverview->image));
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/company-overviews'), $imageName);
            $data['image'] = 'images/company-overviews/' . $imageName;
        }

        $companyOverview->update($data);

        return redirect()->route('admin.company-overview')->with('success', 'Company Overview section updated successfully.');
    }

    public function destroyCompanyOverview($id)
    {
        $companyOverview = CompanyOverview::findOrFail($id);

        // Delete image file
        if ($companyOverview->image && file_exists(public_path($companyOverview->image))) {
            unlink(public_path($companyOverview->image));
        }

        $companyOverview->delete();

        return redirect()->route('admin.company-overview')->with('success', 'Company Overview section deleted successfully.');
    }

    public function toggleCompanyOverviewStatus($id)
    {
        $companyOverview = CompanyOverview::findOrFail($id);
        $companyOverview->update(['is_active' => !$companyOverview->is_active]);

        return redirect()->route('admin.company-overview')->with('success', 'Company Overview status updated successfully.');
    }

    public function leadership()
    {
        $leadership = Leadership::first(); // Get the first (and only) leadership entry
        return view('admin.leadership.leadership', compact('leadership'), ['activeSection' => 'leadership']);
    }

    public function createLeadership()
    {
        return view('admin.leadership.create', ['activeSection' => 'leadership']);
    }

    public function storeLeadership(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'title_basic_description' => 'nullable|string',
            'leader_name' => 'required|string|max:255',
            'leader_role' => 'required|string|max:255',
            'leader_description' => 'nullable|string',
            'leader_quote' => 'nullable|string',
            'leader_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:5120', // 5MB limit
            'is_active' => 'boolean'
        ]);

        $data = $request->all();

        if ($request->hasFile('leader_image')) {
            $imageName = time() . '.' . $request->leader_image->extension();
            $request->leader_image->move(public_path('images/leadership'), $imageName);
            $data['leader_image'] = 'images/leadership/' . $imageName;
        }

        Leadership::create($data);

        return redirect()->route('admin.leadership')->with('success', 'Leadership entry created successfully.');
    }

    public function editLeadership($id)
    {
        $leadership = Leadership::findOrFail($id);
        return view('admin.leadership.edit', compact('leadership'), ['activeSection' => 'leadership']);
    }

    public function updateLeadership(Request $request, $id)
    {
        $leadership = Leadership::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'title_basic_description' => 'nullable|string',
            'leader_name' => 'required|string|max:255',
            'leader_role' => 'required|string|max:255',
            'leader_description' => 'nullable|string',
            'leader_quote' => 'nullable|string',
            'leader_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:5120', // 5MB limit
            'is_active' => 'boolean'
        ]);

        $data = $request->all();

        if ($request->hasFile('leader_image')) {
            // Delete old image
            if ($leadership->leader_image && file_exists(public_path($leadership->leader_image))) {
                unlink(public_path($leadership->leader_image));
            }

            $imageName = time() . '.' . $request->leader_image->extension();
            $request->leader_image->move(public_path('images/leadership'), $imageName);
            $data['leader_image'] = 'images/leadership/' . $imageName;
        }

        $leadership->update($data);

        return redirect()->route('admin.leadership')->with('success', 'Leadership entry updated successfully.');
    }

    public function destroyLeadership($id)
    {
        $leadership = Leadership::findOrFail($id);

        // Delete image file
        if ($leadership->leader_image && file_exists(public_path($leadership->leader_image))) {
            unlink(public_path($leadership->leader_image));
        }

        $leadership->delete();

        return redirect()->route('admin.leadership')->with('success', 'Leadership entry deleted successfully.');
    }

    public function toggleLeadershipStatus($id)
    {
        $leadership = Leadership::findOrFail($id);
        $leadership->update(['is_active' => !$leadership->is_active]);

        return redirect()->route('admin.leadership')->with('success', 'Leadership status updated successfully.');
    }

    public function team()
    {
        $teams = Team::orderBy('sort_order')->orderBy('created_at', 'desc')->get();
        return view('admin.team.team', compact('teams'), ['activeSection' => 'team']);
    }

    public function createTeam()
    {
        return view('admin.team.create', ['activeSection' => 'team']);
    }

    public function storeTeam(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:5120', // 5MB limit
            'sort_order' => 'integer',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/teams'), $imageName);
            $data['image'] = 'images/teams/' . $imageName;
        }

        Team::create($data);

        return redirect()->route('admin.team')->with('success', 'Team member created successfully.');
    }

    public function editTeam($id)
    {
        $team = Team::findOrFail($id);
        return view('admin.team.edit', compact('team'), ['activeSection' => 'team']);
    }

    public function updateTeam(Request $request, $id)
    {
        $team = Team::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:5120', // 5MB limit
            'sort_order' => 'integer',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            // Delete old image
            if ($team->image && file_exists(public_path($team->image))) {
                unlink(public_path($team->image));
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/teams'), $imageName);
            $data['image'] = 'images/teams/' . $imageName;
        }

        $team->update($data);

        return redirect()->route('admin.team')->with('success', 'Team member updated successfully.');
    }

    public function destroyTeam($id)
    {
        $team = Team::findOrFail($id);

        // Delete image file
        if ($team->image && file_exists(public_path($team->image))) {
            unlink(public_path($team->image));
        }

        $team->delete();

        return redirect()->route('admin.team')->with('success', 'Team member deleted successfully.');
    }

    public function toggleTeamStatus($id)
    {
        $team = Team::findOrFail($id);
        $team->update(['is_active' => !$team->is_active]);

        return redirect()->route('admin.team')->with('success', 'Team member status updated successfully.');
    }

    public function mentorship()
    {
        $mentorships = Mentorship::orderBy('sort_order')->orderBy('created_at', 'desc')->get();
        return view('admin.mentorship.mentorship', compact('mentorships'), ['activeSection' => 'mentorship']);
    }

    public function createMentorship()
    {
        return view('admin.mentorship.create', ['activeSection' => 'mentorship']);
    }

    public function storeMentorship(Request $request)
    {
        $request->validate([
            'icon' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'sort_order' => 'integer',
            'is_active' => 'boolean'
        ]);

        Mentorship::create($request->all());

        return redirect()->route('admin.mentorship')->with('success', 'Mentorship item created successfully.');
    }

    public function editMentorship($id)
    {
        $mentorship = Mentorship::findOrFail($id);
        return view('admin.mentorship.edit', compact('mentorship'), ['activeSection' => 'mentorship']);
    }

    public function updateMentorship(Request $request, $id)
    {
        $mentorship = Mentorship::findOrFail($id);

        $request->validate([
            'icon' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'sort_order' => 'integer',
            'is_active' => 'boolean'
        ]);

        $mentorship->update($request->all());

        return redirect()->route('admin.mentorship')->with('success', 'Mentorship item updated successfully.');
    }

    public function destroyMentorship($id)
    {
        $mentorship = Mentorship::findOrFail($id);
        $mentorship->delete();

        return redirect()->route('admin.mentorship')->with('success', 'Mentorship item deleted successfully.');
    }

    public function toggleMentorshipStatus($id)
    {
        $mentorship = Mentorship::findOrFail($id);
        $mentorship->update(['is_active' => !$mentorship->is_active]);

        return redirect()->route('admin.mentorship')->with('success', 'Mentorship status updated successfully.');
    }

    public function technicalSpecializations()
    {
        $technicalSpecializations = TechnicalSpecialization::orderBy('sort_order')->orderBy('created_at', 'desc')->get();
        return view('admin.technical-specializations.technical-specializations', compact('technicalSpecializations'), ['activeSection' => 'technical-specializations']);
    }

    public function createTechnicalSpecialization()
    {
        return view('admin.technical-specializations.create', ['activeSection' => 'technical-specializations']);
    }

    public function storeTechnicalSpecialization(Request $request)
    {
        $request->validate([
            'descriptions' => 'required|array|min:1',
            'descriptions.*' => 'required|string',
            'sort_order' => 'integer',
            'is_active' => 'boolean'
        ]);

        // Filter out empty descriptions
        $descriptions = array_filter($request->descriptions, function($desc) {
            return !empty(trim($desc));
        });

        TechnicalSpecialization::create([
            'descriptions' => $descriptions,
            'sort_order' => $request->sort_order,
            'is_active' => $request->is_active
        ]);

        return redirect()->route('admin.technical-specializations')->with('success', 'Technical specialization created successfully.');
    }

    public function editTechnicalSpecialization($id)
    {
        $technicalSpecialization = TechnicalSpecialization::findOrFail($id);
        return view('admin.technical-specializations.edit', compact('technicalSpecialization'), ['activeSection' => 'technical-specializations']);
    }

    public function updateTechnicalSpecialization(Request $request, $id)
    {
        $technicalSpecialization = TechnicalSpecialization::findOrFail($id);

        $request->validate([
            'descriptions' => 'required|array|min:1',
            'descriptions.*' => 'required|string',
            'sort_order' => 'integer',
            'is_active' => 'boolean'
        ]);

        // Filter out empty descriptions
        $descriptions = array_filter($request->descriptions, function($desc) {
            return !empty(trim($desc));
        });

        $technicalSpecialization->update([
            'descriptions' => $descriptions,
            'sort_order' => $request->sort_order,
            'is_active' => $request->is_active
        ]);

        return redirect()->route('admin.technical-specializations')->with('success', 'Technical specialization updated successfully.');
    }

    public function destroyTechnicalSpecialization($id)
    {
        $technicalSpecialization = TechnicalSpecialization::findOrFail($id);
        $technicalSpecialization->delete();

        return redirect()->route('admin.technical-specializations')->with('success', 'Technical specialization deleted successfully.');
    }

    public function toggleTechnicalSpecializationStatus($id)
    {
        $technicalSpecialization = TechnicalSpecialization::findOrFail($id);
        $technicalSpecialization->update(['is_active' => !$technicalSpecialization->is_active]);

        return redirect()->route('admin.technical-specializations')->with('success', 'Technical specialization status updated successfully.');
    }

    public function certifications()
    {
        $certifications = Certification::orderBy('sort_order')->orderBy('created_at', 'desc')->get();
        return view('admin.certifications.certifications', compact('certifications'), ['activeSection' => 'certifications']);
    }

    public function createCertification()
    {
        return view('admin.certifications.create', ['activeSection' => 'certifications']);
    }

    public function storeCertification(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'certificate_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:5120', // 5MB limit
            'sort_order' => 'integer',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();

        if ($request->hasFile('certificate_image')) {
            $imageName = time() . '.' . $request->certificate_image->extension();
            $request->certificate_image->move(public_path('images/certifications'), $imageName);
            $data['certificate_image'] = 'images/certifications/' . $imageName;
        }

        Certification::create($data);

        return redirect()->route('admin.certifications')->with('success', 'Certification created successfully.');
    }

    public function editCertification($id)
    {
        $certification = Certification::findOrFail($id);
        return view('admin.certifications.edit', compact('certification'), ['activeSection' => 'certifications']);
    }

    public function updateCertification(Request $request, $id)
    {
        $certification = Certification::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'certificate_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:5120', // 5MB limit
            'sort_order' => 'integer',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();

        if ($request->hasFile('certificate_image')) {
            // Delete old image
            if ($certification->certificate_image && file_exists(public_path($certification->certificate_image))) {
                unlink(public_path($certification->certificate_image));
            }

            $imageName = time() . '.' . $request->certificate_image->extension();
            $request->certificate_image->move(public_path('images/certifications'), $imageName);
            $data['certificate_image'] = 'images/certifications/' . $imageName;
        }

        $certification->update($data);

        return redirect()->route('admin.certifications')->with('success', 'Certification updated successfully.');
    }

    public function destroyCertification($id)
    {
        $certification = Certification::findOrFail($id);

        // Delete image file
        if ($certification->certificate_image && file_exists(public_path($certification->certificate_image))) {
            unlink(public_path($certification->certificate_image));
        }

        $certification->delete();

        return redirect()->route('admin.certifications')->with('success', 'Certification deleted successfully.');
    }

    public function toggleCertificationStatus($id)
    {
        $certification = Certification::findOrFail($id);
        $certification->update(['is_active' => !$certification->is_active]);

        return redirect()->route('admin.certifications')->with('success', 'Certification status updated successfully.');
    }

    public function memberships()
    {
        $memberships = Membership::orderBy('sort_order')->orderBy('created_at', 'desc')->get();
        return view('admin.memberships.memberships', compact('memberships'), ['activeSection' => 'memberships']);
    }

    public function createMembership()
    {
        return view('admin.memberships.create', ['activeSection' => 'memberships']);
    }

    public function storeMembership(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'membership_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:5120', // 5MB limit
            'sort_order' => 'integer',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();

        if ($request->hasFile('membership_image')) {
            $imageName = time() . '.' . $request->membership_image->extension();
            $request->membership_image->move(public_path('images/memberships'), $imageName);
            $data['membership_image'] = 'images/memberships/' . $imageName;
        }

        Membership::create($data);

        return redirect()->route('admin.memberships')->with('success', 'Membership created successfully.');
    }

    public function editMembership($id)
    {
        $membership = Membership::findOrFail($id);
        return view('admin.memberships.edit', compact('membership'), ['activeSection' => 'memberships']);
    }

    public function updateMembership(Request $request, $id)
    {
        $membership = Membership::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'membership_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:5120', // 5MB limit
            'sort_order' => 'integer',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();

        if ($request->hasFile('membership_image')) {
            // Delete old image
            if ($membership->membership_image && file_exists(public_path($membership->membership_image))) {
                unlink(public_path($membership->membership_image));
            }

            $imageName = time() . '.' . $request->membership_image->extension();
            $request->membership_image->move(public_path('images/memberships'), $imageName);
            $data['membership_image'] = 'images/memberships/' . $imageName;
        }

        $membership->update($data);

        return redirect()->route('admin.memberships')->with('success', 'Membership updated successfully.');
    }

    public function destroyMembership($id)
    {
        $membership = Membership::findOrFail($id);

        // Delete image file
        if ($membership->membership_image && file_exists(public_path($membership->membership_image))) {
            unlink(public_path($membership->membership_image));
        }

        $membership->delete();

        return redirect()->route('admin.memberships')->with('success', 'Membership deleted successfully.');
    }

    public function toggleMembershipStatus($id)
    {
        $membership = Membership::findOrFail($id);
        $membership->update(['is_active' => !$membership->is_active]);

        return redirect()->route('admin.memberships')->with('success', 'Membership status updated successfully.');
    }

    public function clientsFeedback()
    {
        $clientFeedbacks = ClientFeedback::orderBy('sort_order')->orderBy('created_at', 'desc')->get();
        return view('admin.clients-feedback.clients-feedback', compact('clientFeedbacks'), ['activeSection' => 'clients-feedback']);
    }

    public function createClientFeedback()
    {
        return view('admin.clients-feedback.create', ['activeSection' => 'clients-feedback']);
    }

    public function storeClientFeedback(Request $request)
    {
        $request->validate([
            'feedbacker_name' => 'required|string|max:255',
            'feedbacker_role' => 'required|string|max:255',
            'feedback_star_rate' => 'required|integer|min:1|max:5',
            'feedback_description' => 'required|string',
            'feedback_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:5120', // 5MB limit
            'sort_order' => 'integer',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();

        if ($request->hasFile('feedback_image')) {
            $imageName = time() . '.' . $request->feedback_image->extension();
            $request->feedback_image->move(public_path('images/client-feedbacks'), $imageName);
            $data['feedback_image'] = 'images/client-feedbacks/' . $imageName;
        }

        ClientFeedback::create($data);

        return redirect()->route('admin.clients-feedback')->with('success', 'Client feedback created successfully.');
    }

    public function editClientFeedback($id)
    {
        $clientFeedback = ClientFeedback::findOrFail($id);
        return view('admin.clients-feedback.edit', compact('clientFeedback'), ['activeSection' => 'clients-feedback']);
    }

    public function updateClientFeedback(Request $request, $id)
    {
        $clientFeedback = ClientFeedback::findOrFail($id);

        $request->validate([
            'feedbacker_name' => 'required|string|max:255',
            'feedbacker_role' => 'required|string|max:255',
            'feedback_star_rate' => 'required|integer|min:1|max:5',
            'feedback_description' => 'required|string',
            'feedback_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:5120', // 5MB limit
            'sort_order' => 'integer',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();

        if ($request->hasFile('feedback_image')) {
            // Delete old image
            if ($clientFeedback->feedback_image && file_exists(public_path($clientFeedback->feedback_image))) {
                unlink(public_path($clientFeedback->feedback_image));
            }

            $imageName = time() . '.' . $request->feedback_image->extension();
            $request->feedback_image->move(public_path('images/client-feedbacks'), $imageName);
            $data['feedback_image'] = 'images/client-feedbacks/' . $imageName;
        }

        $clientFeedback->update($data);

        return redirect()->route('admin.clients-feedback')->with('success', 'Client feedback updated successfully.');
    }

    public function destroyClientFeedback($id)
    {
        $clientFeedback = ClientFeedback::findOrFail($id);

        // Delete image file
        if ($clientFeedback->feedback_image && file_exists(public_path($clientFeedback->feedback_image))) {
            unlink(public_path($clientFeedback->feedback_image));
        }

        $clientFeedback->delete();

        return redirect()->route('admin.clients-feedback')->with('success', 'Client feedback deleted successfully.');
    }

    public function toggleClientFeedbackStatus($id)
    {
        $clientFeedback = ClientFeedback::findOrFail($id);
        $clientFeedback->update(['is_active' => !$clientFeedback->is_active]);

        return redirect()->route('admin.clients-feedback')->with('success', 'Client feedback status updated successfully.');
    }

    public function partners()
    {
        $partners = Partner::orderBy('sort_order')->orderBy('created_at', 'desc')->get();
        return view('admin.partners.partners', compact('partners'), ['activeSection' => 'partners']);
    }

    public function createPartner()
    {
        return view('admin.partners.create', ['activeSection' => 'partners']);
    }

    public function storePartner(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:5120', // 5MB limit
            'sort_order' => 'integer',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/partners'), $imageName);
            $data['image'] = 'images/partners/' . $imageName;
        }

        Partner::create($data);

        return redirect()->route('admin.partners')->with('success', 'Partner created successfully.');
    }

    public function editPartner($id)
    {
        $partner = Partner::findOrFail($id);
        return view('admin.partners.edit', compact('partner'), ['activeSection' => 'partners']);
    }

    public function updatePartner(Request $request, $id)
    {
        $partner = Partner::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:5120', // 5MB limit
            'sort_order' => 'integer',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            // Delete old image
            if ($partner->image && file_exists(public_path($partner->image))) {
                unlink(public_path($partner->image));
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/partners'), $imageName);
            $data['image'] = 'images/partners/' . $imageName;
        }

        $partner->update($data);

        return redirect()->route('admin.partners')->with('success', 'Partner updated successfully.');
    }

    public function destroyPartner($id)
    {
        $partner = Partner::findOrFail($id);

        // Delete image file
        if ($partner->image && file_exists(public_path($partner->image))) {
            unlink(public_path($partner->image));
        }

        $partner->delete();

        return redirect()->route('admin.partners')->with('success', 'Partner deleted successfully.');
    }

    public function togglePartnerStatus($id)
    {
        $partner = Partner::findOrFail($id);
        $partner->update(['is_active' => !$partner->is_active]);

        return redirect()->route('admin.partners')->with('success', 'Partner status updated successfully.');
    }

    public function whyChoose()
    {
        $whyChooses = WhyChoose::orderBy('created_at', 'desc')->get(); // Get all why choose entries
        return view('admin.why-choose.why-choose', compact('whyChooses'), ['activeSection' => 'why-choose']);
    }

    public function createWhyChoose()
    {
        return view('admin.why-choose.create', ['activeSection' => 'why-choose']);
    }

    public function storeWhyChoose(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();

        WhyChoose::create($data);

        return redirect()->route('admin.why-choose')->with('success', 'Why Choose section created successfully.');
    }

    public function editWhyChoose($id)
    {
        $whyChoose = WhyChoose::findOrFail($id);
        return view('admin.why-choose.edit', compact('whyChoose'), ['activeSection' => 'why-choose']);
    }

    public function updateWhyChoose(Request $request, $id)
    {
        $whyChoose = WhyChoose::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();

        $whyChoose->update($data);

        return redirect()->route('admin.why-choose')->with('success', 'Why Choose section updated successfully.');
    }

    public function destroyWhyChoose($id)
    {
        $whyChoose = WhyChoose::findOrFail($id);

        $whyChoose->delete();

        return redirect()->route('admin.why-choose')->with('success', 'Why Choose section deleted successfully.');
    }

    public function toggleWhyChooseStatus($id)
    {
        $whyChoose = WhyChoose::findOrFail($id);
        $whyChoose->update(['is_active' => !$whyChoose->is_active]);

        return redirect()->route('admin.why-choose')->with('success', 'Why Choose status updated successfully.');
    }

    public function featuredHighlights()
    {
        $featuredHighlights = FeaturedHighlight::orderBy('sort_order')->orderBy('created_at', 'desc')->get();
        return view('admin.featured-highlights.featured-highlights', compact('featuredHighlights'), ['activeSection' => 'featured-highlights']);
    }

    public function createFeaturedHighlight()
    {
        return view('admin.featured-highlights.create', ['activeSection' => 'featured-highlights']);
    }

    public function storeFeaturedHighlight(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:image,video',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:5120', // 5MB limit for images
            'video_url' => 'nullable|url',
            'sort_order' => 'integer',
            'is_active' => 'boolean'
        ]);

        // Ensure proper validation based on type
        if ($request->type === 'image') {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp,svg|max:5120'
            ]);
        } elseif ($request->type === 'video') {
            $request->validate([
                'video_url' => 'required|url'
            ]);
        }

        $data = $request->all();

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/featured-highlights'), $imageName);
            $data['image'] = 'images/featured-highlights/' . $imageName;
        }

        FeaturedHighlight::create($data);

        return redirect()->route('admin.featured-highlights')->with('success', 'Featured highlight created successfully.');
    }

    public function editFeaturedHighlight($id)
    {
        $featuredHighlight = FeaturedHighlight::findOrFail($id);
        return view('admin.featured-highlights.edit', compact('featuredHighlight'), ['activeSection' => 'featured-highlights']);
    }

    public function updateFeaturedHighlight(Request $request, $id)
    {
        $featuredHighlight = FeaturedHighlight::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:image,video',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:5120', // 5MB limit for images
            'video_url' => 'nullable|url',
            'sort_order' => 'integer',
            'is_active' => 'boolean'
        ]);

        // Ensure proper validation based on type
        if ($request->type === 'image') {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp,svg|max:5120'
            ]);
        } elseif ($request->type === 'video') {
            $request->validate([
                'video_url' => 'required|url'
            ]);
        }

        $data = $request->all();

        if ($request->hasFile('image')) {
            // Delete old image
            if ($featuredHighlight->image && file_exists(public_path($featuredHighlight->image))) {
                unlink(public_path($featuredHighlight->image));
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/featured-highlights'), $imageName);
            $data['image'] = 'images/featured-highlights/' . $imageName;
        }

        $featuredHighlight->update($data);

        return redirect()->route('admin.featured-highlights')->with('success', 'Featured highlight updated successfully.');
    }

    public function destroyFeaturedHighlight($id)
    {
        $featuredHighlight = FeaturedHighlight::findOrFail($id);

        // Delete image file if exists
        if ($featuredHighlight->image && file_exists(public_path($featuredHighlight->image))) {
            unlink(public_path($featuredHighlight->image));
        }

        $featuredHighlight->delete();

        return redirect()->route('admin.featured-highlights')->with('success', 'Featured highlight deleted successfully.');
    }

    public function toggleFeaturedHighlightStatus($id)
    {
        $featuredHighlight = FeaturedHighlight::findOrFail($id);
        $featuredHighlight->update(['is_active' => !$featuredHighlight->is_active]);

        return redirect()->route('admin.featured-highlights')->with('success', 'Featured highlight status updated successfully.');
    }

    public function latestNews()
    {
        $latestNews = LatestNews::orderBy('sort_order')->orderBy('created_at', 'desc')->get();
        return view('admin.latest-news.latest-news', compact('latestNews'), ['activeSection' => 'latest-news']);
    }

    public function createLatestNews()
    {
        return view('admin.latest-news.create', ['activeSection' => 'latest-news']);
    }

    public function storeLatestNews(Request $request)
    {
        $request->validate([
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:5120', // 5MB limit
            'main_title' => 'required|string|max:255',
            'description' => 'required|string',
            'key_highlights' => 'nullable|array',
            'key_highlights.*' => 'nullable|string|max:255',
            'news_quote_description' => 'nullable|string',
            'news_feedbacker' => 'nullable|string|max:255',
            'last_description' => 'nullable|string',
            'sort_order' => 'integer',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();

        // Handle key highlights - filter out empty values
        if (isset($data['key_highlights'])) {
            $data['key_highlights'] = array_filter($data['key_highlights'], function($value) {
                return !empty(trim($value));
            });
        }

        if ($request->hasFile('main_image')) {
            $imageName = time() . '.' . $request->main_image->extension();
            $request->main_image->move(public_path('images/latest-news'), $imageName);
            $data['main_image'] = 'images/latest-news/' . $imageName;
        }

        LatestNews::create($data);

        return redirect()->route('admin.latest-news')->with('success', 'Latest news created successfully.');
    }

    public function editLatestNews($id)
    {
        $latestNews = LatestNews::findOrFail($id);
        return view('admin.latest-news.edit', compact('latestNews'), ['activeSection' => 'latest-news']);
    }

    public function updateLatestNews(Request $request, $id)
    {
        $latestNews = LatestNews::findOrFail($id);

        $request->validate([
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:5120', // 5MB limit
            'main_title' => 'required|string|max:255',
            'description' => 'required|string',
            'key_highlights' => 'nullable|array',
            'key_highlights.*' => 'nullable|string|max:255',
            'news_quote_description' => 'nullable|string',
            'news_feedbacker' => 'nullable|string|max:255',
            'last_description' => 'nullable|string',
            'sort_order' => 'integer',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();

        // Handle key highlights - filter out empty values
        if (isset($data['key_highlights'])) {
            $data['key_highlights'] = array_filter($data['key_highlights'], function($value) {
                return !empty(trim($value));
            });
        }

        if ($request->hasFile('main_image')) {
            // Delete old image
            if ($latestNews->main_image && file_exists(public_path($latestNews->main_image))) {
                unlink(public_path($latestNews->main_image));
            }

            $imageName = time() . '.' . $request->main_image->extension();
            $request->main_image->move(public_path('images/latest-news'), $imageName);
            $data['main_image'] = 'images/latest-news/' . $imageName;
        }

        $latestNews->update($data);

        return redirect()->route('admin.latest-news')->with('success', 'Latest news updated successfully.');
    }

    public function destroyLatestNews($id)
    {
        $latestNews = LatestNews::findOrFail($id);

        // Delete image file if exists
        if ($latestNews->main_image && file_exists(public_path($latestNews->main_image))) {
            unlink(public_path($latestNews->main_image));
        }

        $latestNews->delete();

        return redirect()->route('admin.latest-news')->with('success', 'Latest news deleted successfully.');
    }

    public function toggleLatestNewsStatus($id)
    {
        $latestNews = LatestNews::findOrFail($id);
        $latestNews->update(['is_active' => !$latestNews->is_active]);

        return redirect()->route('admin.latest-news')->with('success', 'Latest news status updated successfully.');
    }

    public function businessHours()
    {
        $businessHours = BusinessHours::first(); // Get the first (and only) business hours entry
        return view('admin.business-hours.business-hours', compact('businessHours'), ['activeSection' => 'business-hours']);
    }

    public function createBusinessHours()
    {
        return view('admin.business-hours.create', ['activeSection' => 'business-hours']);
    }

    public function storeBusinessHours(Request $request)
    {
        $request->validate([
            'monday_from' => 'nullable|date_format:H:i',
            'monday_to' => 'nullable|date_format:H:i|after:monday_from',
            'tuesday_from' => 'nullable|date_format:H:i',
            'tuesday_to' => 'nullable|date_format:H:i|after:tuesday_from',
            'wednesday_from' => 'nullable|date_format:H:i',
            'wednesday_to' => 'nullable|date_format:H:i|after:wednesday_from',
            'thursday_from' => 'nullable|date_format:H:i',
            'thursday_to' => 'nullable|date_format:H:i|after:thursday_from',
            'friday_from' => 'nullable|date_format:H:i',
            'friday_to' => 'nullable|date_format:H:i|after:friday_from',
            'saturday_status' => 'required|in:closed,open',
            'saturday_from' => 'nullable|date_format:H:i|required_if:saturday_status,open',
            'saturday_to' => 'nullable|date_format:H:i|required_if:saturday_status,open|after:saturday_from',
            'sunday_status' => 'required|in:closed,open',
            'sunday_from' => 'nullable|date_format:H:i|required_if:sunday_status,open',
            'sunday_to' => 'nullable|date_format:H:i|required_if:sunday_status,open|after:sunday_from',
            'is_active' => 'boolean'
        ]);

        BusinessHours::create($request->all());

        return redirect()->route('admin.business-hours')->with('success', 'Business hours created successfully.');
    }

    public function editBusinessHours($id)
    {
        $businessHours = BusinessHours::findOrFail($id);
        return view('admin.business-hours.edit', compact('businessHours'), ['activeSection' => 'business-hours']);
    }

    public function updateBusinessHours(Request $request, $id)
    {
        $businessHours = BusinessHours::findOrFail($id);

        $request->validate([
            'monday_from' => 'nullable|date_format:H:i',
            'monday_to' => 'nullable|date_format:H:i|after:monday_from',
            'tuesday_from' => 'nullable|date_format:H:i',
            'tuesday_to' => 'nullable|date_format:H:i|after:tuesday_from',
            'wednesday_from' => 'nullable|date_format:H:i',
            'wednesday_to' => 'nullable|date_format:H:i|after:wednesday_from',
            'thursday_from' => 'nullable|date_format:H:i',
            'thursday_to' => 'nullable|date_format:H:i|after:thursday_from',
            'friday_from' => 'nullable|date_format:H:i',
            'friday_to' => 'nullable|date_format:H:i|after:friday_from',
            'saturday_status' => 'required|in:closed,open',
            'saturday_from' => 'nullable|date_format:H:i|required_if:saturday_status,open',
            'saturday_to' => 'nullable|date_format:H:i|required_if:saturday_status,open|after:saturday_from',
            'sunday_status' => 'required|in:closed,open',
            'sunday_from' => 'nullable|date_format:H:i|required_if:sunday_status,open',
            'sunday_to' => 'nullable|date_format:H:i|required_if:sunday_status,open|after:sunday_from',
            'is_active' => 'boolean'
        ]);

        $businessHours->update($request->all());

        return redirect()->route('admin.business-hours')->with('success', 'Business hours updated successfully.');
    }

    public function destroyBusinessHours($id)
    {
        $businessHours = BusinessHours::findOrFail($id);
        $businessHours->delete();

        return redirect()->route('admin.business-hours')->with('success', 'Business hours deleted successfully.');
    }

    public function toggleBusinessHoursStatus($id)
    {
        $businessHours = BusinessHours::findOrFail($id);
        $businessHours->update(['is_active' => !$businessHours->is_active]);

        return redirect()->route('admin.business-hours')->with('success', 'Business hours status updated successfully.');
    }

    public function contactForm()
    {
        return view('admin.contact-form.contact-form', ['activeSection' => 'contact-form']);
    }

    public function getInTouch()
    {
        $getInTouches = GetInTouch::orderBy('sort_order')->orderBy('created_at', 'desc')->get();
        return view('admin.get-in-touch.get-in-touch', compact('getInTouches'), ['activeSection' => 'get-in-touch']);
    }

    public function createGetInTouch()
    {
        return view('admin.get-in-touch.create', ['activeSection' => 'get-in-touch']);
    }

    public function storeGetInTouch(Request $request)
    {
        $request->validate([
            'contact_type' => 'required|in:call,email,visit',
            'icon' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
            'sort_order' => 'integer',
            'is_active' => 'boolean'
        ]);

        // Additional validation based on contact type
        if ($request->contact_type === 'call') {
            $request->validate(['phone' => 'required|string|max:20']);
        } elseif ($request->contact_type === 'email') {
            $request->validate(['email' => 'required|email|max:255']);
        } elseif ($request->contact_type === 'visit') {
            $request->validate(['address' => 'required|string']);
        }

        GetInTouch::create($request->all());

        return redirect()->route('admin.get-in-touch')->with('success', 'Contact information created successfully.');
    }

    public function editGetInTouch($id)
    {
        $getInTouch = GetInTouch::findOrFail($id);
        return view('admin.get-in-touch.edit', compact('getInTouch'), ['activeSection' => 'get-in-touch']);
    }

    public function updateGetInTouch(Request $request, $id)
    {
        $getInTouch = GetInTouch::findOrFail($id);

        $request->validate([
            'contact_type' => 'required|in:call,email,visit',
            'icon' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
            'sort_order' => 'integer',
            'is_active' => 'boolean'
        ]);

        // Additional validation based on contact type
        if ($request->contact_type === 'call') {
            $request->validate(['phone' => 'required|string|max:20']);
        } elseif ($request->contact_type === 'email') {
            $request->validate(['email' => 'required|email|max:255']);
        } elseif ($request->contact_type === 'visit') {
            $request->validate(['address' => 'required|string']);
        }

        $getInTouch->update($request->all());

        return redirect()->route('admin.get-in-touch')->with('success', 'Contact information updated successfully.');
    }

    public function destroyGetInTouch($id)
    {
        $getInTouch = GetInTouch::findOrFail($id);
        $getInTouch->delete();

        return redirect()->route('admin.get-in-touch')->with('success', 'Contact information deleted successfully.');
    }

    public function toggleGetInTouchStatus($id)
    {
        $getInTouch = GetInTouch::findOrFail($id);
        $getInTouch->update(['is_active' => !$getInTouch->is_active]);

        return redirect()->route('admin.get-in-touch')->with('success', 'Contact information status updated successfully.');
    }

    public function jobApplications()
    {
        $jobApplications = JobApplication::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.job-applications.job-applications', compact('jobApplications'), ['activeSection' => 'job-applications']);
    }

    public function showJobApplication($id)
    {
        $jobApplication = JobApplication::findOrFail($id);
        return view('admin.job-applications.show', compact('jobApplication'), ['activeSection' => 'job-applications']);
    }

    public function updateJobApplicationStatus(Request $request, $id)
    {
        $jobApplication = JobApplication::findOrFail($id);

        $request->validate([
            'status' => 'required|in:pending,reviewed,shortlisted,rejected,hired',
            'admin_notes' => 'nullable|string'
        ]);

        $data = $request->only(['status', 'admin_notes']);

        if ($request->status !== 'pending' && !$jobApplication->reviewed_at) {
            $data['reviewed_at'] = now();
        }

        $jobApplication->update($data);

        return redirect()->back()->with('success', 'Job application status updated successfully.');
    }

    public function replyToJobApplication(Request $request, $id)
    {
        $jobApplication = JobApplication::findOrFail($id);

        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'cc_admin' => 'boolean'
        ]);

        try {
            // Here you would integrate with your email service (Gmail SMTP)
            // For now, we'll just log the email details
            Log::info('Job Application Reply', [
                'application_id' => $id,
                'to' => $jobApplication->email,
                'subject' => $request->subject,
                'message' => $request->message,
                'cc_admin' => $request->cc_admin
            ]);

            // You can integrate with Laravel Mail here
            // Mail::to($jobApplication->email)->send(new JobApplicationReply($jobApplication, $request->subject, $request->message));

            return redirect()->back()->with('success', 'Reply sent successfully to ' . $jobApplication->email);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to send reply: ' . $e->getMessage());
        }
    }

    public function downloadResume($id)
    {
        $jobApplication = JobApplication::findOrFail($id);

        if (!$jobApplication->resume_path || !file_exists(public_path($jobApplication->resume_path))) {
            return redirect()->back()->with('error', 'Resume file not found.');
        }

        return response()->download(public_path($jobApplication->resume_path));
    }

    public function destroyJobApplication($id)
    {
        $jobApplication = JobApplication::findOrFail($id);

        // Delete resume file if exists
        if ($jobApplication->resume_path && file_exists(public_path($jobApplication->resume_path))) {
            unlink(public_path($jobApplication->resume_path));
        }

        $jobApplication->delete();

        return redirect()->route('admin.job-applications')->with('success', 'Job application deleted successfully.');
    }

    public function logout()
    {
        return view('admin.logout.logout', ['activeSection' => 'logout']);
    }
}
