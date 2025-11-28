import React, { useEffect, useState } from 'react'
import { images } from '../assets'
import { API, getCertifications, getCompanyOverview } from '../api';
import { useNavigate } from 'react-router-dom';


function About() {

  const navigate = useNavigate(); // Initialize navigate


  const [memberships, setMemberships] = useState([]);
  const [overview, setOverview] = useState(null);

  useEffect(() => {
    const fetchData = async () => {
      try {
        const data = await getCompanyOverview();
        console.log("overview", data)
        setOverview(data);
      } catch (error) {
        console.error("Failed to load company overview", error);
      }
    };

    fetchData();
  }, []);

  useEffect(() => {
    const fetchCertifications = async () => {
      try {
        const data = await getCertifications();
        setMemberships(data);
        console.log(data)
      } catch (error) {
        console.error('Error fetching achievements:', error);
      }
    };

    fetchCertifications();
  }, []);

  if (!overview) return <p>Loading...</p>;

  return (
    <div className='' >

      <section className="py-16 px-6 md:px-12 lg:px-24">
        <div className="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
          {/* Text Section */}
          <div>
            <h2 className="text-2xl md:text-3xl font-bold uppercase mb-4">
              {overview.title}
            </h2>
            <p className="text-gray-600 mb-4">
              {overview.first_description}
            </p>
            <p className="text-gray-600 mb-6">
              {overview.second_description}
            </p>

            {/* Stats */}
            <div className="flex flex-wrap gap-4 mb-6">
              <div className="bg-white shadow-md rounded-xl px-6 py-4 text-center">
                <h3 className="text-2xl font-bold text-orange-500">{overview.years_experience}+</h3>
                <p className="text-sm text-gray-500">Years Experience</p>
              </div>
              <div className="bg-white shadow-md rounded-xl px-6 py-4 text-center">
                <h3 className="text-2xl font-bold text-orange-500">{overview.projects_completed}+</h3>
                <p className="text-sm text-gray-500">Projects Completed</p>
              </div>
              <div className="bg-white shadow-md rounded-xl px-6 py-4 text-center">
                <h3 className="text-2xl font-bold text-orange-500">{overview.expert_engineers}+</h3>
                <p className="text-sm text-gray-500">Expert Engineers</p>
              </div>
            </div>

            {/* Button */}
            <button
              onClick={() => navigate("/projects")}
              className="inline-flex items-center gap-2 bg-orange-500 text-white px-6 py-3 rounded-full shadow hover:bg-orange-600 transition"
            >
              View Our Projects
              <span>↗</span>
            </button>
          </div>

          {/* Image Section */}
          <div>
            <img
              src={`${API}/${overview.image}`}
              alt="Company Engineering Project"
              className="rounded-2xl shadow-lg w-full object-cover"
            />
          </div>
        </div>
      </section>

      <section className="py-16 px-6 md:px-12 lg:px-24 bg-gray-50">
        <div className="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-12">
          {/* Vision */}
          <div className="text-center md:text-left max-w-lg mx-auto md:mx-0 border border-gray-200 rounded-lg p-6 md:p-8 bg-white shadow-sm hover:scale-105 transition-all duration-300 hover:border-blue-500 hover:shadow-lg">
            <div className="flex items-center justify-center md:justify-start gap-4 mb-6">
              <img
                src={images.Vision}
                alt="Vision Icon"
                className="w-16 h-16 md:w-18 md:h-18"
              />
              <h3 className="text-2xl font-bold text-gray-800">VISION</h3>
            </div>
            <p className="text-gray-600 leading-relaxed text-lg">
              {overview.vision_description}
            </p>
            <div className="mt-8 border-b border-gray-100"></div>
          </div>

          {/* Mission */}
          <div className="text-center md:text-left max-w-lg mx-auto md:mx-0 border border-gray-200 rounded-lg p-6 md:p-8 bg-white shadow-sm hover:scale-105 transition-all duration-300 hover:border-blue-500 hover:shadow-lg">
            <div className="flex items-center justify-center md:justify-start gap-4 mb-6">
              <img
                src={images.Mission}
                alt="Mission Icon"
                className="w-16 h-16 md:w-18 md:h-18"
              />
              <h3 className="text-2xl font-bold text-gray-800">MISSION</h3>
            </div>
            <ul className="space-y-3 text-gray-600">
              {overview.mission_points.map((point, i) => (
                <li key={i} className="flex items-start">
                  <span className="text-blue-500 mr-3 mt-1">•</span>
                  <span className="text-lg text-left">{point}</span>
                </li>
              ))}
            </ul>
            <div className="mt-8 border-b border-gray-100"></div>
          </div>
        </div>
      </section>

      {/* Certifications & Memberships */}
      <section className="text-center max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h2 className="text-2xl font-bold text-gray-800 uppercase">Certifications & Memberships</h2>
        <p className="text-[#1e1e1e] mb-8 mt-2">
          Recognized and accredited by leading industry bodies
        </p>

        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 max-w-6xl mx-auto px-4">
          {memberships.map((membership, index) => (
            <div key={index} className="bg-white">
              <img
                src={membership.img}
                alt={membership.title}
                className="ml-4 w-14 h-14 object-cover"
              />
              <div className="p-4 text-start">
                <h3 className="text-sm font-semibold text-black">{membership.title}</h3>
                <p className="text-gray-500 text-sm mt-2">{membership.location}</p>
              </div>
            </div>
          ))}
        </div>
      </section>

      {/* Our Team */}
      <section className="text-center my-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h2 className="text-2xl font-bold text-gray-800 uppercase">Our Team</h2>

        {/* img */}
        <div className="gap-6 max-w-6xl mt-10 mx-auto px-4">
          <img src={images.OurTeam} />
        </div>


      </section>

    </div>
  )
}

export default About