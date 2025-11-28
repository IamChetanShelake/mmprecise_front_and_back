import React, { useState, useEffect } from "react";
import { BsGraphUpArrow } from "react-icons/bs";
import { icons, images } from "../assets";
import { Link } from "react-router-dom";
import { API, getProjects } from "../api";

function Projects() {
    const [activeTab, setActiveTab] = useState("ongoing");
    const [projects, setProjects] = useState([]);

    useEffect(() => {
        const fetchProjects = async () => {
          try {
            const data = await getProjects();
            setProjects(data);
            console.log("getProjects", data)
          } catch (error) {
            console.error('Error fetching Projects:', error);
          }
        };
    
        fetchProjects();
      }, []);

    const filteredProjects = projects.filter((project) =>
        project.type === activeTab
    ) ?? [];

    return (
        <div className="w-full">
            {/* ---------------- HERO SECTION ---------------- */}
            <section className="w-full py-20 md:py-28 bg-gradient-to-br from-[#F37021] to-[#2C2C2C] text-white flex items-center px-6 md:px-12 lg:px-20 relative">
                <div className="max-w-[1400px] mx-auto w-full flex justify-between relative">
                    <div>
                        <h1 className="text-4xl md:text-5xl font-bold">OUR PROJECTS</h1>
                        <p className="mt-3 text-[16px] opacity-90">
                            Precision in Every Span. Excellence in Every Structure.
                        </p>

                        <button className="mt-6 py-3 px-8 bg-white text-orange-600 rounded-full font-semibold hover:bg-orange-100 transition">
                            Our Services <BsGraphUpArrow className="inline-block" />
                        </button>
                    </div>
                </div>
            </section>

            {/* ---------------- PROJECT FILTER TABS ---------------- */}
            <div className="max-w-[1400px] mx-auto px-6 md:px-12 lg:px-20">
                <div className="flex justify-center mt-10 mb-12">
                    <div className="bg-white rounded-full shadow-lg px-5 py-2 flex gap-4">
                        <button
                            onClick={() => setActiveTab("ongoing")}
                            className={`px-5 py-2 rounded-full font-medium transition ${activeTab === "ongoing" ? "bg-orange-600 text-white" : "text-gray-700"
                                }`}
                        >
                            Ongoing Projects
                        </button>

                        <button
                            onClick={() => setActiveTab("completed")}
                            className={`px-5 py-2 rounded-full font-medium transition ${activeTab === "completed" ? "bg-orange-600 text-white" : "text-gray-700"
                                }`}
                        >
                            Completed Projects
                        </button>
                    </div>
                </div>
            </div>

            {/* ---------------- DYNAMIC PROJECT CARDS ---------------- */}
            <div className="max-w-[1400px] mx-auto flex flex-col gap-8 px-6 md:px-12 lg:px-20 mb-10">
                {filteredProjects.length === 0 ? (
                    <p className="text-center text-gray-500">No projects found.</p>
                ) : (
                    <div className="flex flex-col md:flex-row flex-wrap gap-8">
                        {filteredProjects.map((project) => (
                            <div
                                key={project.id}
                                className="bg-white rounded-xl shadow-lg overflow-hidden hover:-translate-y-1 transition flex flex-col w-full md:w-[calc(50%-16px)]"
                            >
                                {/* Project Image */}
                                <div className="relative group">
                                    <img
                                        // 
                                        src={`${API}/${project.main_image}`}
                                        alt={project.title}
                                        className="h-56 w-full object-cover transition duration-300 group-hover:scale-105"
                                    />

                                    <span className="absolute top-3 right-3 bg-orange-600 text-white text-xs px-3 py-1 rounded-full shadow-lg z-10">
                                        {project.type === "ongoing" ? "Ongoing" : "Completed"}
                                    </span>

                                    <div className="absolute inset-0 bg-black/20 group-hover:bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                                        <div className="text-white flex flex-col items-center">
                                            <img src={icons.faculty} alt="View more" className="w-8 h-8" />
                                            <p className="text-xl font-medium">{project.title}</p>
                                        </div>
                                    </div>
                                </div>

                                {/* Project Content */}
                                <div className="flex flex-col p-4">
                                    <div className="flex justify-between items-start mb-4">
                                        <h3 className="text-xl font-bold">{project.title}</h3>
                                        <Link
                                            to="/project-details"
                                            state={{ projectData: project }} // 👈 passing entire project object
                                            onClick={() => window.scrollTo({ top: 0, left: 0, behavior: "smooth" })} // 👌 Smooth scroll on click
                                        >
                                            <img
                                                src={icons.Plus}
                                                alt="View more"
                                                className="w-8 h-8 cursor-pointer hover:scale-110 transition"
                                            />
                                        </Link>
                                    </div>

                                    <div className="flex flex-col md:flex-row justify-between mb-4">
                                        <div className="text-[14px] space-y-2">
                                            <p className="flex items-center">
                                                <img src={icons.Span} alt="span" className="mr-2 w-4 h-4" />
                                                <b className="text-sm mr-1">Span:</b> {project.span}
                                            </p>
                                            <p className="flex items-center">
                                                <img src={icons.Area} alt="area" className="mr-2 w-4 h-4" />
                                                <b className="text-sm mr-1">Area:</b> {project.area}
                                            </p>
                                            <p className="flex items-center">
                                                <img src={icons.Technology} alt="technology" className="mr-2 w-4 h-4" />
                                                <b className="text-sm mr-1">Technology:</b> {project.technology}
                                            </p>
                                            <p className="flex items-center">
                                                <img src={icons.Completion} alt="completion" className="mr-2 w-4 h-4" />
                                                <b className="text-sm mr-1">Completion:</b> {project.completion}
                                            </p>
                                        </div>
                                    </div>

                                    {/* Dynamic Tags (example: technology & area as tags) */}
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
                            </div>
                        ))}
                    </div>
                )}
            </div>
        </div>
    );
}

export default Projects;
