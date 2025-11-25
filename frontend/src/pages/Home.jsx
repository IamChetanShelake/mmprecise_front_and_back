import React from 'react'
import { CgArrowTopRight } from 'react-icons/cg';
import { images } from '../assets';
import { FaWhatsapp } from 'react-icons/fa';
import TestimonialCard from '../components/TestimonialCard';
import BackGround from '../assets/images/BackGround.png';

const partners = [
  { img: "/images/logo1.png", name: "Logoipsum" },
  { img: "/images/logo2.png", name: "Logoipsum" },
  { img: "/images/logo3.png", name: "Logoipsum" },
  { img: "/images/logo1.png", name: "Logoipsum" },
  { img: "/images/logo2.png", name: "Logoipsum" },
  { img: "/images/logo3.png", name: "Logoipsum" },
  { img: "/images/logo1.png", name: "Logoipsum" },
  { img: "/images/logo2.png", name: "Logoipsum" },
  { img: "/images/logo3.png", name: "Logoipsum" },
  { img: "/images/logo2.png", name: "Logoipsum" },
];

const achievements = [
  {
    img: `${images.award}`, // Replace with real image path
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
    title:
      "WORLD RECORD HOLDER – WORLD RECORD OF INDIA, 2023",
    description:
      "Pre-engineered buildings and post-tensioned slab systems for optimal structural performance.",
  },
];

const stats = [
  { value: "10", label: "PROJECTS" },
  { value: "0", label: "YEARS" },
  { value: "100", label: "WORKFORCE" },
  { value: "5,000", label: "TONNES SAVED" },
];

const testimonials = [
  {
    quote: "MM Precise has been instrumental in delivering our most complex structural projects. Their expertise consistently exceeds expectations.",
    name: "Rajesh Kumar",
    designation: "Project Director, Larsen & Toubro",
    image: "/images/rajesh.jpg",
  },
  {
    quote: "The team's technical expertise and commitment to sustainable practices make them our preferred partner.",
    name: "Priya Sharma",
    designation: "Chief Engineer, Tata Projects",
    image: "/images/priya.jpg",
  },
  {
    quote: "Their innovation and reliability helped us complete major projects efficiently and sustainably.",
    name: "Amit Verma",
    designation: "Senior Manager, XYZ Corp",
    image: "/images/amit.jpg",
  },
];

function Home() {
  return (
    <div className='flex flex-col items-center justify-center' >

      <section
        className="relative w-full h-[90vh] flex items-center justify-center bg-cover bg-center"
        style={{ backgroundImage: `url(${BackGround})` }}      >
        {/* Overlay */}
        <div className="absolute inset-0 bg-black/50"></div>

        {/* Content */}
        <div className="relative text-start px-6 md:px-10 max-w-5xl mx-auto">
          <h1 className="text-3xl md:text-5xl font-bold text-white leading-tight">
            PRECISION IN EVERY SPAN.<br />
            <span className="text-primary">EXCELLENCE IN EVERY STRUCTURE.</span>
          </h1>

          <p className="text-gray-200 mt-4 text-sm md:text-base">
            Delivering turnkey industrial projects with innovation & sustainability.
          </p>

          <button className="mt-6 px-6 py-3 bg-primary hover:bg-orange-600 text-white rounded-full flex gap-2 mx-auto active:scale-95 transition">
            EXPLORE PROJECTS
            <CgArrowTopRight className="w-5 h-5" />
          </button>
        </div>

        
      </section>


      <section className=" flex flex-col md:flex-row items-center justify-between px-6 md:px-16 py-10 md:py-16 gap-10">

        {/* Left Content */}
        <div className="md:w-1/2">
          {/* Label */}
          <p className="inline-block bg-orange-100 text-primary px-4 py-1 rounded-full text-sm font-medium mb-4">
            ABOUT MM PRECISE
          </p>

          {/* Description */}
          <p className="text-gray-700 leading-relaxed">
            Founded in <span className="font-semibold text-primary">2010</span>, MM Precise began as a vision to deliver precision
            engineering solutions that combine <span className="font-semibold text-primary">innovation, sustainability</span>, and
            <span className="font-semibold text-primary"> excellence</span>. What started as a small team of passionate engineers has
            evolved into a comprehensive structural engineering company.
          </p>

          <p className="text-gray-700 leading-relaxed mt-4">
            Today, we stand as a <span className="font-semibold text-primary">Pvt. Ltd. company</span> with a proven track record of
            delivering complex structural projects across various industries. Our commitment to quality, safety, and sustainable practices
            has made us a trusted partner for leading construction companies and developers.
          </p>

          {/* Button */}
          <button className="mt-6 flex items-center gap-2 border border-prtext-primary text-primary px-6 py-2 rounded-full hover:bg-orange-50 transition active:scale-95">
            About Us
            <CgArrowTopRight className="w-5 h-5" />
          </button>
        </div>

        {/* Right Image */}
        <div className="md:w-1/2">
          <img
            src={images.BackGround}
            alt="MM Precise Overview"
            className="w-[500px] h-auto rounded-xl shadow-xl"
          />
        </div>
      </section>

      <section className="w-full py-8 flex justify-center">
        <div className="bg-orange-50 py-6 px-10 flex flex-wrap md:flex-nowrap gap-6 md:gap-12">
          {stats.map((item, index) => (
            <div
              key={index}
              className="text-center px-4 relative"
            >
              {/* Divider Line */}
              {index !== stats.length - 1 && (
                <span className="hidden md:block absolute right-0 top-1/2 transform -translate-y-1/2 w-px h-12 bg-orange-200"></span>
              )}

              <h3 className="text-primary text-2xl font-bold">{item.value}</h3>
              <p className="text-xs text-gray-600 tracking-wide mt-1">{item.label}</p>
            </div>
          ))}
        </div>
      </section>


      {/* ACHIEVEMENTS & AWARDS */}
      <section className="text-center max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h2 className="text-2xl font-bold text-gray-800">ACHIEVEMENTS & AWARDS</h2>
        <p className="text-[#1e1e1e] mb-8 mt-2">
          Recognized for excellence and innovation in structural engineering
        </p>


        {/* Cards */}
        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto px-4">
          {achievements.map((award, index) => (
            <div
              key={index}
              className="bg-white  "
            >
              <img src={award.img} alt={award.title} className="w-full h-40 object-cover overflow-hidden hover:scale-105 transition-transform" />

              <div className="p-4 text-start">
                <h3 className="text-sm font-semibold text-black">{award.title}</h3>
                <p className="text-gray-500 text-sm mt-2">{award.description}</p>
              </div>
            </div>
          ))}
        </div>

        {/* Button */}
        <div className="text-center mt-8">
          <button className="px-6 py-3 bg-yellow-400 rounded-full text-sm font-semibold hover:bg-yellow-500 transition flex items-center mx-auto gap-2">
            VIEW ALL ACHIEVEMENTS
            <span><CgArrowTopRight className='w-5 h-5' /></span>
          </button>
        </div>
      </section>


      {/* Testominical */}
      <section className="py-10 max-w-6xl mx-auto px-4">
        <div className="text-center mb-8">
          <h2 className="text-2xl font-bold text-gray-800">What Our Clients Say</h2>
          <p className="text-[#1e1e1e] mb-8 mt-2">
            Trusted by industry leaders for excellence and innovation
          </p>
        </div>

        <div className="grid md:grid-cols-3 gap-6">
          {testimonials.map((item, index) => (
            <TestimonialCard key={index} testimonial={item} />
          ))}
        </div>
      </section>

      {/* Our Partner */}
      <div className="text-center max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h2 className="text-2xl font-bold text-gray-800">Our Partner</h2>
        <p className="text-[#1e1e1e] mb-8 mt-2">
          Trusted partners who help us deliver excellence across every project.
        </p>

        <div className="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6 justify-items-center">
          {partners.map((partner, index) => (
            <div
              key={index}
              className="flex flex-col items-center gap-2 hover:scale-105 transition-transform"
            >
              <img src={partner.img} alt={partner.name} className="object-cover" />
              {/* <span className="text-gray-600 text-sm">{partner.name}</span> */}
            </div>
          ))}
        </div>
      </div>
    </div>
  )
}

export default Home