import React, { useState, useEffect } from "react";
import { useLocation } from "react-router-dom";
import { icons } from "../assets";
import { API } from "../api";

const ProjectDetails = () => {
    const [activeTab, setActiveTab] = useState("");
    const [project, setProject] = useState(null);

    const location = useLocation();
    const { projectData } = location.state || {}; // Receiving entire project as state

    useEffect(() => {
        if (projectData) {
            setProject(projectData); // Set project from state
        }
    }, [projectData]);

    if (!project) {
        return <p className="text-center py-10 text-gray-600">Loading project details...</p>;
    }

    const tabs = ["Features", "Gallery", "Achievements", "Strength Results"];

    const renderRightContent = () => {
        switch (activeTab) {
            case "Features":
                return (
                    <div className="bg-white p-6 h-full">
                        <h3 className="text-lg font-semibold mb-4">Features</h3>
                        <ul className="space-y-2 text-sm text-gray-700">
                            {project.features?.length ? (
                                project.features.map((f) => (
                                    <li key={f.id} className="flex items-start gap-3">
                                        <span className="inline-block w-2 h-2 bg-orange-600 rounded-full mt-2"></span>
                                        <span>{f.feature}</span>
                                    </li>
                                ))) : (
                                <li className="text-gray-400">No features available</li>
                            )}
                        </ul>
                    </div>
                );
            case "Gallery":
                return (
                    <div className="grid grid-cols-2 gap-2 p-4 bg-white">
                        {project.galleries?.length ? (
                            project.galleries.map((g) => (
                                <div key={g.id} className="overflow-hidden rounded">
                                    <img
                                        src={`${API}/${g.image}`}
                                        alt={`gallery-${g.id}`}
                                        className="w-full h-40 object-cover"
                                    />
                                </div>
                            ))
                        ) : (
                            <div className="col-span-2 p-4 text-gray-400">No gallery images available</div>
                        )}
                    </div>
                );
            case "Achievements":
                return (
                    <div className="p-4 bg-white">
                        {project.achievements?.length ? (
                            project.achievements.map((a) => (
                                <div key={a.id} className="flex gap-4 items-start mb-4">
                                    <img src={`${API}/${a.photo}`} alt={a.title} className="w-20 h-20 object-cover rounded" />
                                    <div>
                                        <h4 className="font-semibold">{a.title}</h4>
                                        <p className="text-sm text-gray-600">{a.description}</p>
                                    </div>
                                </div>
                            ))
                        ) : (
                            <p className="text-gray-400">No achievements available</p>
                        )}
                    </div>
                );
            case "Strength Results":
                return (
                    <div className="p-4 bg-white">
                        {project.strength_results?.length ? (
                            project.strength_results.map((s) => (
                                <div key={s.id} className="mb-4">
                                    <h4 className="font-semibold">{s.title}</h4>
                                    <p className="text-sm text-gray-600">{s.description}</p>
                                </div>
                            ))
                        ) : (
                            <p className="text-gray-400">No strength results available</p>
                        )}
                    </div>
                );
            default:
                return null;
        }
    };

    return (
        <div className="max-w-[1400px] mx-auto px-6 md:px-12 lg:px-20 py-12">
            <h1 className="text-3xl font-bold mb-6">{project.title}</h1>

            {/* Tabs */}
            <div className="flex flex-wrap gap-2 mb-8 justify-start">
                {tabs.map((tab) => (
                    <button
                        key={tab}
                        onClick={() => setActiveTab(tab)}
                        className={`px-4 py-2 text-[8px] sm:text-sm md:text-base rounded-full transition border w-auto
        ${activeTab === tab
                                ? "bg-orange-600 text-white"
                                : "bg-white text-gray-600 hover:bg-gray-50 border-orange-600"
                            }`}
                    >
                        {tab}
                    </button>
                ))}
            </div>


            <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
                {/* Left Section */}
                <div>
                    <p className="text-gray-700 mb-6 leading-relaxed">{project.description}</p>

                    <div className="text-[14px] space-y-4 mb-4 md:mb-0">
                        <div className="flex items-center">
                            <img src={icons.Span} className="w-4 h-4 mr-2" />
                            <strong className="text-sm mr-1">Span:</strong> {project.span}
                        </div>

                        <div className="flex items-center">
                            <img src={icons.Area} className="w-4 h-4 mr-2" />
                            <strong className="text-sm mr-1">Area:</strong> {project.area}
                        </div>

                        <div className="flex items-center">
                            <img src={icons.Technology} className="w-4 h-4 mr-2" />
                            <strong className="text-sm mr-1">Technology:</strong> {project.technology}
                        </div>

                        <div className="flex items-center">
                            <img src={icons.Completion} className="w-4 h-4 mr-2" />
                            <strong className="text-sm mr-1">Completion:</strong> {project.completion}
                        </div>
                    </div>

                    {/* Dynamic Tags */}
                    <div className="flex flex-wrap my-6">
                        <div className="flex items-center mr-2 mt-2 text-white text-xs py-1 px-3 rounded-full bg-orange-600">
                            <img src={icons.layer} alt="tag-icon" className="w-4 h-4 mr-1" />
                            <span className="text-white text-sm">Post-Tensioning</span>
                        </div>

                        <div className="flex items-center mr-2 mt-2 text-white text-xs py-1 px-3 rounded-full bg-gray-900">
                            <img src={icons.cube} alt="tag-icon" className="w-4 h-4 mr-1" />
                            <span className="text-white text-sm">Fibre Concrete</span>
                        </div>

                        <div className="flex items-center mr-2 mt-2 text-white text-xs py-1 px-3 rounded-full bg-green-600">
                            <img src={icons.leaf} alt="tag-icon" className="w-4 h-4 mr-1" />
                            <span className="text-white text-sm">Green Building</span>
                        </div>
                    </div>
                </div>

                {/* Right Section */}
                <div className="overflow-hidden">
                    {renderRightContent() ? (
                        renderRightContent()
                    ) : (
                        <div className="overflow-hidden rounded-xl shadow-lg">
                            <img
                                src={`${API}/${project.main_image}`}
                                alt={project.title}
                                className="h-56 w-full object-cover transition duration-300 group-hover:scale-105"
                            />
                        </div>
                    )}
                </div>

            </div>
        </div>
    );
};

export default ProjectDetails;