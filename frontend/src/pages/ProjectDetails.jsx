import React, { useState } from "react";
import { BsGraphUpArrow } from "react-icons/bs";
import { FaRulerCombined, FaTools } from "react-icons/fa";
import { BiArea } from "react-icons/bi";
import { MdDateRange } from "react-icons/md";
import { icons } from "../assets";

const ProjectDetails = () => {
    const [activeTab, setActiveTab] = useState("Information");

    const project = {
        id: 3,
        title: "INDUSTRIAL COMPLEX - PUNE",
        span: "45m",
        area: "25,000 sq.m",
        tech: "Post-Tensioning",
        completion: "Q2 2025",
        status: "completed",
        image: "/images/img (3).png",
        tags: [
            { text: "Post-Tensioning", color: "bg-orange-600" },
            { text: "Fibre Concrete", color: "bg-gray-900" },
            { text: "Green Building", color: "bg-green-600" },
        ],
    };


    const tabs = ["Information", "Gallery", "Achievement", "Strength Result Test"];

    return (
        <div className="max-w-[1400px] mx-auto px-6 md:px-12 lg:px-20 py-12">
            {/* Title */}
            <h1 className="text-3xl font-bold mb-6">{project.title}</h1>

            {/* Tabs */}
            <div className="flex gap-2 mb-8">
                {tabs.map((tab) => (
                    <button
                        key={tab}
                        onClick={() => setActiveTab(tab)}
                        className={`px-4 py-2 text-sm rounded-full transition border
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
                    <p className="text-gray-700 mb-6 leading-relaxed">
                        Large-scale industrial facility featuring advanced post-tensioning
                        systems and sustainable construction practices.
                    </p>

                    {/* Info List */}
                    <div className="text-[14px] space-y-2 mb-4 md:mb-0">
                        <p className="flex items-center">
                            <img src={icons.Span} alt="span" className="mr-2 w-4 h-4" />
                            <p className="text-sm font-semibold">Span:</p >
                            <p className="text-sm px-2 ">{project.span}</p>
                        </p>
                        <p className="flex items-center">
                            <img src={icons.Area} alt="area" className="mr-2 w-4 h-4" />
                            <p className="text-sm font-semibold">Area:</p>
                            <p className="text-sm px-2 ">{project.area}</p>
                        </p>
                        <p className="flex items-center">
                            <img src={icons.Technology} alt="technology" className="mr-2 w-4 h-4" />
                            <p className="text-sm font-semibold">Technology:</p >
                            <p className="text-sm px-2 ">{project.tech}</p>
                        </p>
                        <p className="flex items-center">
                            <img src={icons.Completion} alt="completion" className="mr-2 w-4 h-4" />
                            <p className="text-sm font-semibold">Completion:</p>
                            <p className="text-sm px-2 ">{project.completion}</p>
                        </p>
                    </div>

                    {/* Tags */}
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

                {/* Right Section (Image) */}
                <div className="overflow-hidden rounded-xl shadow-lg">
                    <img
                        src={project.image}
                        alt="Project"
                        className="w-full h-[350px] object-cover"
                    />
                </div>
            </div>
        </div>
    );
};

export default ProjectDetails;
