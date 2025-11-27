import React, { useEffect, useState } from 'react'
import { icons, images } from '../assets';
import { FaGraduationCap } from 'react-icons/fa';
import { FiBookOpen } from 'react-icons/fi';
import { BsBuildingsFill } from 'react-icons/bs';
import { getAchievements, getMentorship, getSpecializations } from '../api';
import { Achievements } from '../components';

function Leadership() {
  const [achievements, setAchievements] = useState([]);
  const [mentorship, setMentorship] = useState([]);
  const [specializations, setSpecializations] = useState([]);
  const [loading, setLoading] = useState({
    achievements: true,
    mentorship: true,
    specializations: true
  });

  useEffect(() => {
    const fetchAchievements = async () => {
      try {
        const data = await getAchievements();
        setAchievements(data || []);
      } catch (error) {
        console.error('Error fetching achievements:', error);
        setAchievements([]);
      } finally {
        setLoading(prev => ({ ...prev, achievements: false }));
      }
    };

    fetchAchievements();
  }, []);

  // top 3 Achievements
  const topThreeAchievements = achievements
    ?.sort((a, b) => a.sort_order - b.sort_order)
    ?.slice(0, 3);

  useEffect(() => {
    const fetchMentorship = async () => {
      try {
        const data = await getMentorship();
        setMentorship(data || []);
      } catch (error) {
        console.error('Error fetching Mentorship:', error);
        setMentorship([]);
      } finally {
        setLoading(prev => ({ ...prev, mentorship: false }));
      }
    };

    fetchMentorship();
  }, []);

  useEffect(() => {
    const fetchSpecializations = async () => {
      try {
        const data = await getSpecializations();
        console.log('Specializations API Response:', data); // Debug log
        
        let extractedSpecializations = [];

        // Based on your API function, data is either an array or json.data
        if (Array.isArray(data)) {
          // If it's an array, look for the item with descriptions
          const specItem = data.find(item => item.descriptions && Array.isArray(item.descriptions));
          if (specItem) {
            extractedSpecializations = specItem.descriptions;
          } else {
            // If no descriptions found, use the first item that has string data
            extractedSpecializations = data;
          }
        } 
        // If data is an object with descriptions array (single object response)
        else if (data && data.descriptions && Array.isArray(data.descriptions)) {
          extractedSpecializations = data.descriptions;
        }

        console.log('Extracted Specializations:', extractedSpecializations); // Debug log
        setSpecializations(extractedSpecializations || []);

      } catch (error) {
        console.error('Error fetching Specializations:', error);
        setSpecializations([]);
      } finally {
        setLoading(prev => ({ ...prev, specializations: false }));
      }
    };

    fetchSpecializations();
  }, []);

  // If the API response is the exact object you showed me
  const fallbackSpecializations = [
    "Industrial & Long-Span Structures – spans up to 24m",
    "Post-Tensioning, Void PT Slab, Deck Slab Systems",
    "Centering and shuttering designs",
    "Fibre-reinforced concrete",
    "GGBS (Ground Granulated Blast-furnace Slag)",
    "Real-time strength monitoring"
  ];

  // Use API data if available, otherwise use fallback
  const displaySpecializations = specializations.length > 0 ? specializations : fallbackSpecializations;

  return (
    <div className=''>
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

      {/* Mentorship & Knowledge Sharing */}
      <section className="text-center max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h2 className="text-2xl font-bold text-gray-800 uppercase">Mentorship & Knowledge Sharing</h2>

        {/* Cards */}
        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto px-4">
          {mentorship.map((item, index) => (
            <div key={index} className="bg-white">
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

      {/* Technical Specializations */}
      <section className="w-full flex flex-col items-center justify-center py-10 px-4">
        <h2 className="text-2xl font-bold text-gray-800 py-4 uppercase">TECHNICAL SPECIALIZATIONS</h2>
        
        {loading.specializations ? (
          <div className="bg-white shadow-md rounded-2xl border-0 shadow-orange-300 p-6 w-full max-w-5xl">
            <div className="flex justify-center items-center py-8">
              <div className="animate-spin rounded-full h-8 w-8 border-b-2 border-orange-500"></div>
            </div>
          </div>
        ) : (
          <div className="bg-white shadow-md rounded-2xl border-0 shadow-orange-300 p-6 w-full max-w-5xl">
            <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
              {/* First column - first 3 items */}
              <ul className="space-y-2">
                {displaySpecializations.slice(0, 3).map((item, idx) => (
                  <li key={idx} className="flex items-center">
                    <div className="rounded-full bg-primary p-1 mr-1.5"></div>
                    <span className="font-normal">{item}</span>
                  </li>
                ))}
              </ul>

              {/* Second column - last 3 items */}
              <ul className="space-y-2">
                {displaySpecializations.slice(3, 6).map((item, idx) => (
                  <li key={idx} className="flex items-center">
                    <span className="rounded-full bg-primary p-1 mr-1.5"></span>
                    <span className='font-normal'>{item}</span>
                  </li>
                ))}
              </ul>
            </div>
          </div>
        )}
      </section>
    </div>
  )
}

export default Leadership