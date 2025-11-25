
import React from 'react';
import { icons, images } from '../assets';
import { FaLeaf } from "react-icons/fa6";
import { HiUserGroup } from "react-icons/hi2";
import { FaHeart } from "react-icons/fa6";
import { HiAcademicCap } from "react-icons/hi2";
import { FaSolarPanel } from "react-icons/fa";
import { FaShieldAlt } from "react-icons/fa";
import { FaTree } from "react-icons/fa6";
import { FaSchool } from "react-icons/fa6";
import { FaClock } from "react-icons/fa6";
import { FaRecycle } from "react-icons/fa";
import { FaBuilding } from "react-icons/fa6";

export default function CSR() {

    const commitmentData = [
      {
        id: 1,
        icon: <FaLeaf className="text-white text-2xl" />,
        title: "ENVIRONMENTAL SUSTAINABILITY",
        description: "Tree plantation drives, waste reduction programs, and eco-friendly construction practices that protect our planet.",
        color: "bg-green-600",
        textColor: "text-green-600",
        hoverColor: "hover:bg-green-700"
      },
      {
        id: 2,
        icon: <HiUserGroup className="text-white text-2xl" />,
        title: "COMMUNITY DEVELOPMENT",
        description: "Empowering local communities through education, skill development, and infrastructure support programs.",
        color: "bg-[#f97316]",
        textColor: "text-[#f97316]",
        hoverColor: "hover:bg-orange-600"
      },
      {
        id: 3,
        icon: <FaHeart className="text-white text-2xl" />,
        title: "HEALTHCARE SUPPORT",
        description: "Medical facility sponsorship and healthcare accessibility programs for underserved communities.",
        color: "bg-[#dc3545]",
        textColor: "text-[#dc3545]",
        hoverColor: "hover:bg-red-600"
      },
      {
        id: 4,
        icon: <HiAcademicCap className="text-white text-2xl" />,
        title: "EDUCATION INITIATIVE",
        description: "Scholarship programs and educational infrastructure development for better learning opportunities.",
        color: "bg-blue-800",
        textColor: "text-blue-800",
        hoverColor: "hover:bg-blue-900"
      },
      {
        id: 5,
        icon: <FaSolarPanel className="text-white text-2xl" />,
        title: "RENEWABLE ENERGY",
        description: "Solar panel installations and renewable energy solutions for sustainable power generation.",
        color: "bg-[#ffc107]",
        textColor: "text-[#ffc107]",
        hoverColor: "hover:bg-yellow-500"
      },
      {
        id: 6,
        icon: <FaShieldAlt className="text-white text-2xl" />,
        title: "SAFETY & WELLNESS",
        description: "Workplace safety programs and employee wellness initiatives for healthier communities.",
        color: "bg-[#6c757d]",
        textColor: "text-[#6c757d]",
        hoverColor: "hover:bg-gray-600"
      }
    ];

    const sustainabilityData = [
      {
        icon: <FaTree className="text-white text-3xl" />,
        color: "#28a745",
        value: "10,000+",
        title: "Trees Planted",
        desc: "Environmental conservation through massive tree plantation drives.",
      },
      {
        icon: <FaSchool className="text-white text-3xl" />,
        color: "#FF6B35",
        value: "50+",
        title: "Schools Supported",
        desc: "Educational infrastructure development & training for underprivileged students.",
      },
      {
        icon: <FaHeart className="text-white text-3xl" />,
        color: "#dc3545",
        value: "500+",
        title: "Families Impacted",
        desc: "Direct support through healthcare, education & livelihood programs.",
      },
      {
        icon: <FaClock className="text-white text-3xl" />,
        color: "#ffc107",
        value: "15+",
        title: "Years of Service",
        desc: "Consistent commitment to corporate social responsibility.",
      },
    ];

    return (
      <div className="w-full font-sans">
        <section className="max-w-7xl mx-auto p-6 grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">
          {/* Text Content */}
          <div className="space-y-4 lg:space-y-6">
            <h1 className="text-4xl lg:text-7xl font-bold text-orange-600 leading-tight tracking-tight">
              CORPORATE <br />
              SOCIAL <br />
              RESPONSIBILITY
            </h1>

            <p className="text-2xl font-bold text-gray-800 leading-relaxed">
              BUILDING BEYOND STRUCTURES – TOWARDS SUSTAINABILITY & COMMUNITY GROWTH
            </p>

            <p className="text-gray-600 font-medium leading-relaxed">
              At MM Precise Constructors, we are committed to creating positive impact through
              sustainable practices, community development, and environmental stewardship.
              Every project we undertake contributes to building a better, greener future
              for generations to come.
            </p>

            <button
              className="mt-4 font-medium bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-full 
                 transition-all duration-300 ease-in-out transform hover:scale-105 
                 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2"
            >
              EXPLORE CSR INITIATIVES →
            </button>
          </div>

          {/* Image */}
          <div className="relative">
            <img
              src={images.csr}
              alt="MM Precise Constructors CSR initiatives showcasing community engagement and sustainable construction practices"
              className="rounded-2xl shadow-lg w-xl h-auto object-cover"
              loading="lazy"
            />
          </div>
        </section>

        <section className="max-w-7xl mx-auto px-6 py-14">
          <h2 className="text-center text-2xl font-semibold mb-12 text-gray-600">
            Our commitment to making positive change across communities
          </h2>

          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
            {commitmentData.map((item) => (
              <div
                key={item.id}
                className="group bg-white p-6 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 border border-gray-100 hover:border-gray-200 cursor-pointer"
              >
                {/* Icon Container with Hover Effect */}
                <div
                  className={`${item.color} ${item.hoverColor} w-14 h-14 rounded-full flex items-center justify-center mb-6 transition-all duration-300 group-hover:scale-110 group-hover:rotate-12`}
                >
                  {item.icon}
                </div>

                {/* Title */}
                <h3 className="font-bold text-xl lg:text-2xl mb-4 text-gray-800 group-hover:text-gray-900 transition-colors">
                  {item.title}
                </h3>

                {/* Description */}
                <p className="text-gray-600 leading-relaxed mb-6 group-hover:text-gray-700 transition-colors">
                  {item.description}
                </p>

                {/* Learn More Link with Enhanced Hover Effect */}
                <div className="mt-auto">
                  <p className={`${item.textColor} font-semibold flex items-center gap-2 transition-all duration-300 group-hover:gap-3`}>
                    Learn More
                    <span className="text-2xl transform transition-transform duration-300 group-hover:translate-x-2">
                      →
                    </span>
                  </p>
                </div>
              </div>
            ))}
          </div>
        </section>

        <section className='w-full bg-[#111]'>
          <div className="max-w-7xl mx-auto text-white py-16 px-4 sm:px-6 lg:px-8">
            {/* Header Section */}
            <div className="text-center mb-12">
              <h1 className="text-gray-400 text-lg md:text-xl font-light leading-relaxed">
                Measurable results from our commitment to sustainable
                <br className="hidden sm:block" />
                development and community support
              </h1>
            </div>

            {/* Cards Grid */}
            <div className="w-full mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">
              {sustainabilityData.map((item, index) => (
                <div
                  key={index}
                  className="bg-[#1A1A1A] h-[400px] p-6 rounded-2xl shadow-xl flex flex-col items-center text-center hover:transform hover:scale-105 transition-all duration-300"
                >
                  {/* Icon Container */}
                  <div
                    className="w-20 h-20 rounded-full flex items-center justify-center my-6  transition-all duration-300 group-hover:scale-110 group-hover:rotate-12"
                    style={{ backgroundColor: item.color }}
                  >
                    {item.icon}
                  </div>

                  {/* Value */}
                  <h1
                    className="text-5xl font-bold my-4 hover:transform hover:scale-105 transition-all duration-300"
                    style={{ color: item.color }}
                  >
                    {item.value}
                  </h1>

                  {/* Title */}
                  <h3 className="text-xl font-semibold text-white mb-3">
                    {item.title}
                  </h3>

                  {/* Description */}
                  <p className="text-sm text-gray-400 leading-relaxed flex-1">
                    {item.desc}
                  </p>
                </div>
              ))}
            </div>
          </div>
        </section>


        <div className="max-w-7xl mx-auto my-20 grid grid-cols-1 md:grid-cols-2 gap-10">

          {/* LEFT Illustration Box */}
          <div className="flex items-center">   {/* Centers vertically */}
            <div className="h-[400px] w-full bg-gradient-to-br from-green-400 to-green-700 rounded-3xl flex flex-col justify-center items-center shadow-xl">
              <img src={icons.leaf} alt="leaf" />
              <h1 className="text-white text-xl font-semibold mt-4">Green Construction</h1>
            </div>
          </div>

          {/* RIGHT Content Boxes */}
          <div className="flex flex-col gap-6">
            {/* Card 1 */}
            <div className="bg-white shadow-lg p-6 rounded-3xl">
              <div className="bg-[#28a745] w-14 h-14 rounded-full flex items-center justify-center mb-4">
                <FaBuilding className="text-white text-3xl" />
              </div>
              <h2 className="text-xl font-bold">Green Building Practices</h2>
              <p className="text-gray-600 mt-2">
                Implementing sustainable building, energy-efficient methods, and
                eco-conscious materials across all projects.
              </p>
            </div>

            {/* Card 2 */}
            <div className="bg-white shadow-lg p-6 rounded-3xl">
              <div className="bg-[#ffc107] w-14 h-14 rounded-full flex items-center justify-center mb-4">
                <FaSolarPanel className="text-white text-3xl" />
              </div>
              <h2 className="text-xl font-bold">Renewable Energy Integration</h2>
              <p className="text-gray-600 mt-2">
                Incorporating solar panels, wind energy systems, and other renewable sources to reduce carbon footprint and promote clean energy.
              </p>
            </div>

            {/* Card 3 */}
            <div className="bg-white shadow-lg p-6 rounded-3xl">
              <div className="bg-gray-600 w-14 h-14 rounded-full flex items-center justify-center mb-4">
                <FaRecycle className="text-white text-3xl" />
              </div>
              <h2 className="text-xl font-bold">Waste Reduction & Recycling</h2>
              <p className="text-gray-600 mt-2">
                Comprehensive waste management systems, material recycling programs, and sustainable resource utilization throughout project lifecycles.
              </p>
            </div>
          </div>
        </div>


      </div>
    );
  }
