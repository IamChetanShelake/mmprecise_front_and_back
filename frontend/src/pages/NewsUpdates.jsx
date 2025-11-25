import React from "react";
import { FiArrowRight } from "react-icons/fi";
import { images } from "../assets";

function NewsUpdates() {
  const achievements = [
    {
      img: `${images.award}`,
      title: "PROMISING ENGINEER AWARD 2022 – IEI NASHIK",
      description:
        "Recognition for outstanding contribution to structural engineering innovation.",
    },
    {
      img: `${images.award}`,
      title:
        "OUTSTANDING CONCRETE STRUCTURE AWARD 2023 – ACCE NASHIK & ULTRATECH",
      description:
        "Advanced engineering for large-scale structures requiring exceptional load capabilities.",
    },
    {
      img: `${images.award}`,
      title: "WORLD RECORD HOLDER – WORLD RECORD OF INDIA, 2023",
      description:
        "Pre-engineered buildings and post-tensioned slab systems for optimal structural performance.",
    },
    {
      img: `${images.award}`,
      title: "PROMISING ENGINEER AWARD 2022 – IEI NASHIK",
      description:
        "Recognition for outstanding contribution to structural engineering innovation.",
    },
    {
      img: `${images.award}`,
      title:
        "OUTSTANDING CONCRETE STRUCTURE AWARD 2023 – ACCE NASHIK & ULTRATECH",
      description:
        "Advanced engineering for large-scale structures requiring exceptional load capabilities.",
    },
    {
      img: `${images.award}`,
      title: "WORLD RECORD HOLDER – WORLD RECORD OF INDIA, 2023",
      description:
        "Pre-engineered buildings and post-tensioned slab systems for optimal structural performance.",
    },
  ];

  return (
    <div>
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

        {/* CARDS GRID */}
        <div className="grid grid-cols-1 lg:grid-cols-2 gap-6 max-w-8xl mx-auto mt-10">
          {/* LEFT BIG CARD */}
          <div className="rounded-xl overflow-hidden shadow-md flex flex-col">
            <img
              src="/images/img (3).png"
              alt="Project Milestone"
              className="w-full h-[460px] object-cover"
            />
            <div className="p-6 bg-white">
              <h3 className="text-lg font-semibold text-gray-900">
                Project Milestone Achieved
              </h3>
              <p className="text-sm text-gray-600 mt-2">
                We successfully completed structural work for the Riverfront
                Residency Project Phase II. The team delivered exceptional quality
                and safety standards—right on schedule.
              </p>
              
            </div>
            <div className="flex items-center justify-end m-4">
                    <button className="mt-4 w-9 h-9 flex items-center justify-center rounded-full border border-gray-300 hover:bg-black hover:text-white transition">
                    <FiArrowRight />
                  </button>
                </div>
          </div>

          {/* RIGHT TWO CARDS */}
          <div className="grid grid-rows-2 gap-6">
            {[
              {
                img: "/images/img (2).png",
                title: "On-Site Safety Drive",
                desc: "Safety first! Our safety team conducted a week-long awareness and training program across all sites, reinforcing strong safety culture.",
              },
              {
                img: "/images/img (1).png",
                title: "Sustainability Initiative",
                desc: "We launched our Green Site Mission—implementing eco-friendly waste handling and optimized water usage systems across all construction zones.",
              },
            ].map((item, i) => (
              <div key={i} className="rounded-xl overflow-hidden shadow-md">
                <img
                  src={item.img}
                  alt={item.title}
                  className="w-full h-[170px] object-cover"
                />
                <div className="px-6 px-2 bg-white">
                  <h3 className="text-lg font-semibold text-gray-900">{item.title}</h3>
                  <p className="text-sm text-gray-600 mt-2">{item.desc}</p>
                  
                </div>
                <div className="flex items-center justify-end m-4">
                    <button className="mt-4 w-9 h-9 flex items-center justify-center rounded-full border border-gray-300 hover:bg-black hover:text-white transition">
                    <FiArrowRight />
                  </button>
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* ACHIEVEMENTS */}
      <section className="text-center py-12 max-w-7xl mx-auto">
        <h2 className="text-2xl font-bold text-gray-800">ACHIEVEMENTS</h2>
        <div className="bg-orange-500 h-1 w-20 mx-auto mt-2 rounded-full"></div>

        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
          {achievements.map((award, index) => (
            <div key={index} className="rounded-xl overflow-hidden shadow-md">
              <img
                src={award.img}
                alt={award.title}
                className="w-full h-44 object-cover"
              />
              <div className="p-4 text-start">
                <h3 className="text-base font-semibold text-black">{award.title}</h3>
                <p className="text-gray-500 text-sm mt-2">{award.description}</p>
              </div>
            </div>
          ))}
        </div>
      </section>
    </div>
  );
}

export default NewsUpdates;
