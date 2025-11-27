
import React, { useEffect, useState } from 'react';
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
import { API, getCSR } from '../api';

export default function CSR() {


  const [data, setData] = useState({});

  useEffect(() => {
    const fetchData = async () => {
      try {
        const responce = await getCSR();
        console.log("getCSR", responce[0])
        setData(responce[0]);
      } catch (error) {
        console.error("Failed to load company overview", error);
      }
    };

    fetchData();
  }, []);



  const commitmentUIConfig = {
    "ENVIRONMENTAL SUSTAINABILITY": {
      icon: <FaLeaf className="text-white text-2xl" />,
      color: "bg-green-600",
      textColor: "text-green-600",
      hoverColor: "hover:bg-green-700",
    },
    "COMMUNITY DEVELOPMENT": {
      icon: <HiUserGroup className="text-white text-2xl" />,
      color: "bg-[#f97316]",
      textColor: "text-[#f97316]",
      hoverColor: "hover:bg-orange-600",
    },
    "HEALTHCARE SUPPORT": {
      icon: <FaHeart className="text-white text-2xl" />,
      color: "bg-[#dc3545]",
      textColor: "text-[#dc3545]",
      hoverColor: "hover:bg-red-600",
    },
    "EDUCATION INITATIVE": {
      icon: <HiAcademicCap className="text-white text-2xl" />,
      color: "bg-blue-800",
      textColor: "text-blue-800",
      hoverColor: "hover:bg-blue-900",
    },
    "RENEWABLE ENERGY": {
      icon: <FaSolarPanel className="text-white text-2xl" />,
      color: "bg-[#ffc107]",
      textColor: "text-[#ffc107]",
      hoverColor: "hover:bg-yellow-500",
    },
    "SAFETY & WELLNESS": {
      icon: <FaShieldAlt className="text-white text-2xl" />,
      color: "bg-[#6c757d]",
      textColor: "text-[#6c757d]",
      hoverColor: "hover:bg-gray-600",
    },
  };

  const commitmentData = (data?.positive_changes || []).map((item) => {
    const config = commitmentUIConfig[item.title.trim()] || {};

    return {
      ...item,
      ...config,
    };
  });



  const sustainabilityUIConfig = {
    "Trees Planted": {
      icon: <FaTree className="text-white text-3xl" />,
      color: "#28a745",
    },
    "Schools Supported": {
      icon: <FaSchool className="text-white text-3xl" />,
      color: "#FF6B35",
    },
    "Families Impacted": {
      icon: <FaHeart className="text-white text-3xl" />,
      color: "#dc3545",
    },
    "Years of Service": {
      icon: <FaClock className="text-white text-3xl" />,
      color: "#ffc107",
    },
  };


  const sustainabilityData = (data?.measurable_results || []).map((item) => {
    // Normalize title (to avoid mismatch with "Services")
    const normalizedTitle = item.title.replace("Services", "Service").trim();

    const config = sustainabilityUIConfig[normalizedTitle] || {
      icon: <FaTree className="text-white text-3xl" />, // fallback icon
      color: "#888888", // fallback color
    };

    return {
      ...item,
      ...config,
      value: `${item.number}+`, // Format number like static
      desc: item.description,
      title: normalizedTitle,
    };
  });

  const greenConstructionUIConfig = {
    "GREEN BUILDING PRACTICES": {
      icon: <FaBuilding className="text-white text-3xl" />,
      color: "#28a745",
    },
    "RENEWABLE ENERGY INTEGRATION": {
      icon: <FaSolarPanel className="text-white text-3xl" />,
      color: "#ffc107",
    },
    "WASTE REDUCTION & RECYCLING": {
      icon: <FaRecycle className="text-white text-3xl" />,
      color: "#6c757d",
    },
  };

  const greenConstructionData = (data?.green_construction || []).map((item) => {
    const config = greenConstructionUIConfig[item.title.trim()] || {
      icon: <FaBuilding className="text-white text-3xl" />,
      color: "#999999", // fallback color
    };

    return {
      ...item,
      ...config,
    };
  });



  return (
    <div className="w-full font-sans">
      <section className="max-w-7xl mx-auto p-6 grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">
        {/* Text Content */}
        <div className="space-y-4 lg:space-y-6">
          <h1 className="text-4xl lg:text-7xl font-bold text-orange-600 leading-tight tracking-tight">
            {data.main_title}
          </h1>

          <p className="text-2xl font-bold text-gray-800 leading-relaxed">
            {data.main_description}            </p>

          <p className="text-gray-600 font-medium leading-relaxed">
            {data.short_description}
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
            src={data?.main_image ? `${API}/${data.main_image}` : images.csr}
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
          {commitmentData.map((item, index) => (
            <div
              key={index}
              className="group bg-white p-6 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 border border-gray-100 hover:border-gray-200 cursor-pointer"
            >
              {/* Icon OR Image */}
              <div
                className={`${item.color} ${item.hoverColor} w-14 h-14 rounded-full flex items-center justify-center mb-6 transition-all duration-300 group-hover:scale-110 group-hover:rotate-12`}
              >
                {item.image ? (
                  <img src={item.image} alt={item.title} className="w-full h-full rounded-full object-cover" />
                ) : (
                  item.icon
                )}
              </div>

              <h3 className="font-bold text-xl lg:text-2xl mb-4 text-gray-800 group-hover:text-gray-900 transition-colors">
                {item.title}
              </h3>

              <p className="text-gray-600 leading-relaxed mb-6 group-hover:text-gray-700 transition-colors">
                {item.description}
              </p>

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
          <div className="text-center mb-12">
            <h1 className="text-gray-400 text-lg md:text-xl font-light leading-relaxed">
              Measurable results from our commitment to sustainable
              <br className="hidden sm:block" />
              development and community support
            </h1>
          </div>

          <div className="w-full mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">
            {sustainabilityData.map((item, index) => (
              <div
                key={index}
                className="bg-[#1A1A1A] h-[400px] p-6 rounded-2xl shadow-xl flex flex-col items-center text-center hover:transform hover:scale-105 transition-all duration-300"
              >
                <div
                  className="w-20 h-20 rounded-full flex items-center justify-center my-6 transition-all duration-300 group-hover:scale-110 group-hover:rotate-12"
                  style={{ backgroundColor: item.color }}
                >
                  {item.image ? (
                    <img src={item.image} alt={item.title} className="w-full h-full object-cover rounded-full" />
                  ) : (
                    item.icon
                  )}
                </div>

                <h1
                  className="text-5xl font-bold my-4 hover:transform hover:scale-105 transition-all duration-300"
                  style={{ color: item.color }}
                >
                  {item.value}
                </h1>

                <h3 className="text-xl font-semibold text-white mb-3">
                  {item.title}
                </h3>

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
        <div className="flex items-center">
          <div className="h-[400px] w-full bg-gradient-to-br from-green-400 to-green-700 rounded-3xl flex flex-col justify-center items-center shadow-xl">
            <img src={icons.leaf} alt="leaf" />
            <h1 className="text-white text-xl font-semibold mt-4">Green Construction</h1>
          </div>
        </div>

        {/* RIGHT Content Boxes */}
        <div className="flex flex-col gap-6">
          {greenConstructionData.map((item, index) => (
            <div
              key={index}
              className="bg-white shadow-lg p-6 rounded-3xl"
            >
              {/* Icon or Image */}
              <div
                className="w-14 h-14 rounded-full flex items-center justify-center mb-4"
                style={{ backgroundColor: item.color }}
              >
                {item.image ? (
                  <img
                    src={item.image}
                    alt={item.title}
                    className="w-full h-full object-cover rounded-full"
                  />
                ) : (
                  item.icon
                )}
              </div>

              {/* Title */}
              <h2 className="text-xl font-bold">
                {item.title}
              </h2>

              {/* Description */}
              <p className="text-gray-600 mt-2">
                {item.description}
              </p>
            </div>
          ))}
        </div>

      </div>


    </div>
  );
}
