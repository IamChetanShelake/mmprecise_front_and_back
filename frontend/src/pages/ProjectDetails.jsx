import React, { useState, useEffect } from "react";
import { useLocation } from "react-router-dom";
import { icons } from "../assets";
import { API } from "../api";

const ProjectDetails = () => {
    const [activeTab, setActiveTab] = useState("Information");
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

    const tabs = ["Information", "Gallery", "Achievement", "Strength Result Test"];

    return (
        <div className="max-w-[1400px] mx-auto px-6 md:px-12 lg:px-20 py-12">
            <h1 className="text-3xl font-bold mb-6">{project.title}</h1>

            {/* Tabs */}
            <div className="flex gap-2 mb-8">
                {tabs.map((tab) => (
                    <button
                        key={tab}
                        onClick={() => setActiveTab(tab)}
                        className={`px-4 py-2 text-sm rounded-full transition border
                            ${
                                activeTab === tab
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

                    <div className="text-[14px] space-y-2 mb-4 md:mb-0">
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
                        {project.tags?.map((tag, index) => (
                            <div
                                key={index}
                                className={`flex items-center mr-2 mt-2 text-white text-xs py-1 px-3 rounded-full ${tag.color}`}
                            >
                                <img src={icons.layer} className="w-4 h-4 mr-1" />
                                {tag.text}
                            </div>
                        ))}
                    </div>
                </div>

                {/* Right Section */}
                <div className="overflow-hidden rounded-xl shadow-lg">
                    <img
                        src={`${API}/${project.main_image}`}
                        alt="Project"
                        className="w-full h-[350px] object-cover"
                    />
                </div>
            </div>
        </div>
    );
};

export default ProjectDetails;