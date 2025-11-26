import React, { useEffect, useState } from 'react'
import { images } from '../assets'
import { getCertifications } from '../api';


function About() {

  const [memberships, setMemberships] = useState([]);

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

  const stats = [
    { value: "10", label: "PROJECTS" },
    { value: "0", label: "YEARS" },
    { value: "100", label: "WORKFORCE" },
  ];


  return (
    <div className='' >

      <section className="py-16 px-6 md:px-12 lg:px-24">
        <div className="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
          {/* Text Section */}
          <div>
            <h2 className="text-2xl md:text-3xl font-bold uppercase mb-4">
              Company Overview
            </h2>
            <p className="text-gray-600 mb-4">
              Founded in <span className="font-semibold">2010</span>, MM Precise
              began as a vision to deliver precision engineering solutions that
              combine{" "}
              <span className="text-orange-500 font-medium">innovation</span>,{" "}
              <span className="text-orange-500 font-medium">sustainability</span>,
              and <span className="text-orange-500 font-medium">excellence</span>.
              What started as a small team of passionate engineers has evolved
              into a comprehensive structural engineering company.
            </p>
            <p className="text-gray-600 mb-6">
              Today, we stand as a{" "}
              <span className="font-semibold text-orange-500">Pvt. Ltd. company</span>{" "}
              with a proven track record of delivering complex structural projects
              across various industries. Our commitment to quality, safety, and
              sustainable practices has made us a trusted partner for leading
              construction companies and developers.
            </p>

            {/* Stats */}
            <div className="flex flex-wrap gap-4 mb-6">
              <div className="bg-white shadow-md rounded-xl px-6 py-4 text-center">
                <h3 className="text-2xl font-bold text-orange-500">14+</h3>
                <p className="text-sm text-gray-500">Years Experience</p>
              </div>
              <div className="bg-white shadow-md rounded-xl px-6 py-4 text-center">
                <h3 className="text-2xl font-bold text-orange-500">500+</h3>
                <p className="text-sm text-gray-500">Projects Completed</p>
              </div>
              <div className="bg-white shadow-md rounded-xl px-6 py-4 text-center">
                <h3 className="text-2xl font-bold text-orange-500">40+</h3>
                <p className="text-sm text-gray-500">Expert Engineers</p>
              </div>
            </div>

            {/* Button */}
            <a
              href="#"
              className="inline-flex items-center gap-2 bg-orange-500 text-white px-6 py-3 rounded-full shadow hover:bg-orange-600 transition"
            >
              View Our Projects
              <span>↗</span>
            </a>
          </div>

          {/* Image Section */}
          <div>
            <img
              src={images.EXPERTISE1}
              alt="Company Engineering Project"
              className="rounded-2xl shadow-lg w-full object-cover"
            />
          </div>
        </div>
      </section>

      <section className="py-16 px-6 md:px-12 lg:px-24">
        <div className="grid grid-cols-1 md:grid-cols-2 gap-10">
          {/* Vision */}
          <div className="text-center max-w-lg border p-4 md:text-left overflow-hidden hover:scale-105 transition-transform hover:border-primary">
            <div className="flex items-center justify-center md:justify-start gap-3 mb-4">
              <img
                src={images.Vision}
                alt="Vision Icon"
                className="w-16 h-16"
              />
              <h3 className="text-xl font-bold">VISION</h3>
            </div>
            <p className="text-gray-600 leading-relaxed">
              To redefine industrial construction in India through innovation,
              precision, and sustainability.
            </p>
            <div className="mt-6 border-b w-full border-gray-200"></div>
          </div>

          {/* Mission */}
          <div className="text-center max-w-lg border p-4  md:text-left overflow-hidden hover:scale-105 transition-transform hover:border-primary">
            <div className="flex items-center justify-center md:justify-start gap-3 mb-4">
              <img
                src={images.Mission}
                alt="Mission Icon"
                className="w-16 h-16"
              />
              <h3 className="text-xl font-bold">MISSION</h3>
            </div>
            <ul className="text-gray-600 space-y-2">
              <li>• Deliver projects with excellence.</li>
              <li>• Adopt sustainable practices.</li>
              <li>• Build lasting relationships.</li>
            </ul>
            <div className="mt-6 border-b w-full border-gray-200"></div>
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