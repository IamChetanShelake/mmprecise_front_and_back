import React from 'react';
import { FiArrowRight } from 'react-icons/fi';

export default function NewsUpdatesDetails() {
    return (
        <div className="max-w-7xl mx-auto p-6">
            {/* HERO SECTION */}
            <section className="container mx-auto px-6 py-12">
                <div className="flex flex-col md:flex-row items-start gap-8 max-w-8xl mx-auto">
                    <div className="md:w-1/3 w-full">
                        <h1 className="text-3xl font-bold uppercase leading-tight">
                            Latest News & Updates
                        </h1>
                        <div className="bg-orange-500 h-1 w-20 mt-2"></div>
                    </div>
                    <div className="md:w-2/3 w-full">
                        <p className="text-gray-600 text-lg leading-8">
                            Stay updated with our latest achievements, project milestones,
                            and industry insights shaping the future of construction.
                        </p>
                    </div>
                </div>

            </section>
            <div className="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div className="lg:col-span-2 space-y-6">
                    <img src="/images/img (3).png" alt="Project Image" className="w-full rounded-2xl shadow" />
                    <div>
                        <h3 className="text-xl font-semibold mb-2">Project Milestone Achieved</h3>
                        <p className="text-gray-700 mb-4">We are pleased to announce the successful completion of structural works for Riverfront Residency Project — Phase II, marking a significant milestone in our ongoing journey to deliver high-quality, future-ready residential spaces. This achievement reflects the dedication and precision of our on-site team, engineers, planners, and skilled workforce who worked cohesively under challenging conditions, while maintaining the highest levels of quality, safety, and technical excellence.</p>
                        <ul className="list-disc pl-5 text-gray-700 space-y-1 mb-4">
                            <li>Successful completion of RCC framework and major civil works</li>
                            <li>Zero-major safety incidents — aligned with our Safe Site Culture</li>
                            <li>Efficient resource planning and workforce coordination</li>
                            <li>Strict adherence to sustainability standards and benchmarks</li>
                            <li>Achieved milestone within scheduled timeline</li>
                        </ul>
                        <blockquote className="border-l-4 border-orange-500 pl-4 italic text-gray-600">“We are extremely proud of our team’s commitment and professionalism...” — Project Head</blockquote>
                    </div>
                </div>

                <div className="space-y-6">
                    <div className="rounded-2xl shadow p-4 border-0">
                        <img src="/images/img (2).png" alt="On-Site Safety Drive" className="w-full rounded-xl mb-2" />
                        <div className="flex items-center justify-between">
                            <h4 className="font-semibold">On-Site Safety Drive</h4>
                            <button className="mt-4 w-9 h-9 flex items-center justify-center rounded-full border border-gray-300 ">
                                <FiArrowRight />
                            </button>
                        </div>
                        <p className="text-gray-600 text-sm">Safety first! Our safety team conducted a week-long awareness and training program across all sites, reinforcing strong safety...</p>
                        
                    </div>

                    <div className="rounded-2xl shadow p-4 border-0">
                        <img src="/images/img (1).png" alt="Sustainability Initiative" className="w-full rounded-xl mb-2" />
                        <div className="flex items-center justify-between">
                            <h4 className="font-semibold">Sustainability Initiative</h4>
                            <button className="mt-4 w-9 h-9 flex items-center justify-center rounded-full border border-gray-300 ">
                                <FiArrowRight />
                            </button>
                        </div>
                        <p className="text-gray-600 text-sm">We launched our Green Site drive — implementing eco-friendly material handling and water usage systems across...</p>

                    </div>

                    <div className="rounded-2xl shadow p-4 border-0">
                        <img src="/images/img (3).png" alt="On-Site Safety Drive" className="w-full rounded-xl mb-2" />
                        <div className="flex items-center justify-between">
                            <h4 className="font-semibold">On-Site Safety Drive</h4>
                            <button className="mt-4 w-9 h-9 flex items-center justify-center rounded-full border border-gray-300 ">
                                <FiArrowRight />
                            </button>
                        </div>
                        <p className="text-gray-600 text-sm">Safety first! Our safety team conducted a week-long awareness and training program across all sites, reinforcing strong safety...</p>
                      
                    </div>
                </div>
            </div>
        </div>
    );
}


