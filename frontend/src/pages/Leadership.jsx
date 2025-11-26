import React, { useEffect, useState } from 'react'
import { icons, images } from '../assets';
import { FaGraduationCap } from 'react-icons/fa';
import { FiBookOpen } from 'react-icons/fi';
import { BsBuildingsFill } from 'react-icons/bs';
import { getAchievements } from '../api';
import {Achievements} from '../components';




function Leadership() {

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

  // top 3 Achievements
  const topThreeAchievements = achievements
    ?.sort((a, b) => a.sort_order - b.sort_order)
    ?.slice(0, 3);

  const leadership = [
    {
      icon: `${icons.Education}`,
      title: "Mentored By",
      description: "Er. Prasanna Bhore.",
    },
    {
      icon: `${icons.Books}`,
      title: "Expert Lectures",
      description: "Regularly delivers talks at engineering institutions",
    },
    {
      icon: `${icons.Site}`,
      title: "Site Visits",
      description: "Hosts educational tours for engineering students",
    },

  ];

  const left = [
    'Industrial & Long-Span Structures – Spans Up To 24m',
    'Post-Tensioning, Void PT Slab, Deck Slab Systems',
    'Centering And Shuttering Designs'
  ];
  const right = [
    'Fibre-Reinforced Concrete',
    'GGBS (Ground Granulated Blast-Furnace Slag)',
    'Real-Time Strength Monitoring'
  ];

  return (
    <div className='' >
      <section className="w-full bg-white px-6 pt-10 relative">

        {/* Hello Button */}
        <div className="text-center">
          <button className="px-4 py-1 bg-gray-100 border rounded-full text-sm">
            Hello
          </button>

          {/* Heading */}
          <h2 className="text-2xl font-bold mt-4">
            I'M <span className="text-orange-500">ER. MAYUR JAIN</span>
          </h2>
          <p className="text-lg font-semibold mt-1">
            FOUNDER & MANAGING DIRECTOR
          </p>
        </div>

        {/* Main Section */}
        <div className="max-w-5xl mx-auto mt-5 flex flex-col md:flex-row justify-between items-center gap-10 relative">

          {/* Left Quote Text */}
          <div className="max-w-sm text-left italic text-gray-700 text-sm relative -top-6 ml-[-4px]">
            <span className="text-orange-500 text-xl">❝</span>
            Improving excellence is our key effort. Building
            structures that ensure strong solutions that lead the
            next era of long-lasting engineering with a commitment
            to community.
          </div>


          {/* Center Image */}
          <div className="relative z-10 w-[390px] h-[350px] mx-auto">
            {/* Profile Image */}
            <img
              src={images.Owner}
              alt="profile"
              className="absolute top-1 left-0 w-[200px] h-auto object-contain"
            />

            {/* Background Semi-Circle */}
            <div className="absolute bottom-4 left-1/5 -translate-x-1/2 w-[390px] h-[230px] bg-orange-200 rounded-t-full -z-10"></div>
          </div>


          {/* Right Experience Box */}
          <div className="text-right relative -top-2">
            <p className="text-orange-500 text-xl">★★★★★</p>
            <p className="text-4xl font-bold text-black leading-tight">
              15 Years
            </p>
            <p className="text-sm font-bold mt-3">Experience</p>
          </div>

        </div>
      </section>

      
      <div>
        <Achievements
        heading={"ACHIEVEMENTS & AWARDS"}
        subheading={"Recognized for excellence and innovation in structural engineering"}
        achievements={topThreeAchievements}
        showButton={true}
        />
        
      </div>

    


      {/* ACHIEVEMENTS & AWARDS */}
      <section className="text-center max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h2 className="text-2xl font-bold text-gray-800 uppercase">Mentorship & Knowledge Sharing</h2>

        {/* Cards */}
        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto px-4">
          {leadership.map((item, index) => (
            <div
              key={index}
              className="bg-white"
            >
              <div className="flex items-center gap-3 py-4 px-4">
                <img src={item.icon} className="text-primary w-10 h-10 flex items-center justify-center" />

                <h3 className="text-sm font-semibold text-black">{item.title}</h3>
              </div>
              <div className="pl-14 text-start">
                <p className="text-gray-500 text-sm">{item.description}</p>
              </div>
            </div>
          ))}
        </div>

      </section>

      <section className="w-full flex flex-col items-center justify-center py-10 px-4">
        <h2 className="text-2xl font-bold text-gray-800 py-4 uppercase">TECHNICAL SPECIALIZATIONS</h2>
        <div className="bg-white shadow-md rounded-2xl border-0 shadow-orange-300 p-6 w-full max-w-5xl">
          <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
            <ul className="space-y-2">
              {left.map((item, idx) => (
                <li key={idx} className="flex items-center">
                  <div className="rounded-full bg-primary p-1 mr-1.5"></div>
                  <span className='font-normal'>{item}</span>
                </li>
              ))}
            </ul>
            <ul className="space-y-2">
              {right.map((item, idx) => (
                <li key={idx} className="flex items-center">
                  <span className="rounded-full bg-primary p-1 mr-1.5"></span>
                  <span className='font-normal'>{item}</span>
                </li>
              ))}
            </ul>
          </div>
        </div>
      </section>

    </div>
  )
}

export default Leadership