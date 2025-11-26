import React, { useEffect, useState } from "react";
import { FiArrowRight } from "react-icons/fi";
import { images } from "../assets";
import { Achievements } from '../components';
import { getAchievements } from "../api/achievementsApi";

function NewsUpdates() {
  const [achievements, setAchievements] = useState([]);

  useEffect(() => {
    const fetchAchievements = async () => {
      try {
        const data = await getAchievements();
        setAchievements(data);
      } catch (error) {
        console.error('Error fetching achievements:', error);
      } 
    };

    fetchAchievements();
  }, []);

  // View All Achievements
  const allAchievements = achievements?.sort((a, b) => a.sort_order - b.sort_order);


  return (
    <div>
      {/* HERO SECTION */}
      <section className="container mx-auto px-6 py-12">
        <div className="flex flex-col md:flex-row items-start gap-8 max-w-7xl mx-auto">
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
        <div className="grid grid-cols-1 lg:grid-cols-2 gap-6 max-w-7xl mx-auto mt-10">
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

      <div>
        <Achievements
          heading={"ACHIEVEMENTS"}
          achievements={allAchievements}
          showButton={false}
        />

      </div>
    </div>
  );
}

export default NewsUpdates;
