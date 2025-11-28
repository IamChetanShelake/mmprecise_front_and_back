import React, { useEffect, useState } from 'react'
import { CgArrowTopRight } from 'react-icons/cg';
import TestimonialCard from '../components/TestimonialCard';
import { API, getAboutUs, getAchievements, getHeroSection, getOurPartner, getTestimonials } from '../api';
import { Achievements } from '../components';
import { FaArrowLeft, FaArrowRight } from 'react-icons/fa';
import Slider from "react-slick";
import { useNavigate } from 'react-router-dom';

function Home() {

  const navigate = useNavigate(); // Initialize navigate


  const [achievements, setAchievements] = useState([]);
  const [partners, setPartners] = useState([]);
  const [testimonials, setTestimonials] = useState([]);
  const [herosection, setHerosection] = useState([]);
  const [aboutus, setAboutUs] = useState([]);

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

  useEffect(() => {
    const fetchPartners = async () => {
      try {
        const data = await getOurPartner();
        setPartners(data);
      } catch (error) {
        console.error('Error fetching Partners:', error);
      }
    };

    fetchPartners();
  }, []);

  useEffect(() => {
    const fetchTestimonials = async () => {
      try {
        const data = await getTestimonials();
        setTestimonials(data);
      } catch (error) {
        console.error('Error fetching Testimonials:', error);
      }
    };

    fetchTestimonials();

  }, []);

  const sliderRef = React.useRef(null);

  const settings = {
    dots: false,
    infinite: testimonials.length > 1,
    speed: 500,
    slidesToShow: 3,
    slidesToScroll: 1,
    arrows: false,
    autoplay: false,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
          infinite: testimonials.length > 2,
        }
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          infinite: testimonials.length > 1,
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          infinite: testimonials.length > 1,
        }
      }
    ],
  };

  useEffect(() => {
    const fetchHeroSection = async () => {
      try {
        const data = await getHeroSection();
        setHerosection(data);
      } catch (error) {
        console.error('Error fetching Hero Section:', error);
      }
    };

    fetchHeroSection();
  }, []);

  useEffect(() => {
    const fetchAboutUs = async () => {
      try {
        const data = await getAboutUs();
        setAboutUs(data);
        console.log("getAboutUs", data)
      } catch (error) {
        console.error('Error fetching AboutUs:', error);
      }
    };

    fetchAboutUs();
  }, []);


  return (
    <div className='flex flex-col items-center justify-center' >

      <section
        className="relative w-full h-[90vh] flex items-center justify-start bg-cover bg-center"
        style={{ backgroundImage: `url(${API}/${herosection.background_image})` }}
      >
        {/* Overlay */}
        <div className="absolute inset-0 bg-black/50"></div>

        {/* Content */}
        <div className="relative text-start px-6 md:px-10 max-w-5xl mx-auto">
          <h1 className="text-3xl md:text-5xl font-bold text-white leading-tight">
            {herosection.first_title}<br />
            <span className="text-primary">{herosection.second_title}</span>
          </h1>

          <p className="text-gray-200 mt-4 text-sm md:text-base max-w-2xl">
            {herosection.description}
          </p>

          <div className="flex items-center justify-start">
            <button
              onClick={() => navigate("/projects")}
              className="mt-6 px-6 py-3 bg-primary hover:bg-orange-600 text-white rounded-full flex gap-2 justify-start items-center active:scale-95 transition duration-200">
              EXPLORE PROJECTS
              <CgArrowTopRight className="w-5 h-5" />
            </button>
          </div>
        </div>
      </section>



      <section className=" flex flex-col md:flex-row items-center justify-between px-6 md:px-16 py-10 md:py-16 gap-10">

        {/* Left Content */}
        <div className="md:w-1/2">
          {/* Label */}
          <p className="inline-block bg-orange-100 text-primary px-4 py-1 rounded-full text-sm font-medium mb-4">
            {aboutus.title}
          </p>

          {/* Description */}
          <p className="text-gray-700 leading-relaxed">
            {aboutus.first_description}
          </p>

          <p className="text-gray-700 leading-relaxed mt-4">
            {aboutus.second_description}
          </p>

          {/* Button */}
          <button onClick={() => {
            navigate("/about-us");
            window.scrollTo(0, 0);
          }}
            className="mt-6 flex items-center gap-2 border border-prtext-primary text-primary px-6 py-2 rounded-full hover:bg-orange-50 transition active:scale-95">
            About Us
            <CgArrowTopRight className="w-5 h-5" />
          </button>
        </div>

        {/* Right Image */}
        <div className="md:w-1/2">
          <img
            src={`${API}/${aboutus.image}`}
            alt="MM Precise Overview"
            className="w-[500px] h-auto rounded-xl shadow-xl"
          />
        </div>
      </section>


      <section className="w-full py-8 flex justify-center">
        <div className="
      bg-orange-50 py-6 px-6 sm:px-8 md:px-10 
      grid grid-cols-2 md:flex md:flex-nowrap 
      gap-4 sm:gap-6 md:gap-12
    "
        >
          {/* First Item */}
          <div className="text-center px-2 sm:px-4 relative">
            <h3 className="text-primary text-xl sm:text-2xl font-bold">{aboutus.projects_count}</h3>
            <p className="text-xs sm:text-sm text-gray-600 tracking-wide mt-1">PROJECTS</p>
            <span className="hidden md:block absolute right-0 top-1/2 transform -translate-y-1/2 w-px h-12 bg-orange-200"></span>
          </div>

          {/* Second Item */}
          <div className="text-center px-2 sm:px-4 relative">
            <h3 className="text-primary text-xl sm:text-2xl font-bold">{aboutus.years_count}</h3>
            <p className="text-xs sm:text-sm text-gray-600 tracking-wide mt-1">YEARS</p>
            <span className="hidden md:block absolute right-0 top-1/2 transform -translate-y-1/2 w-px h-12 bg-orange-200"></span>
          </div>

          {/* Third Item */}
          <div className="text-center px-2 sm:px-4 relative">
            <h3 className="text-primary text-xl sm:text-2xl font-bold">{aboutus.workforce_count}</h3>
            <p className="text-xs sm:text-sm text-gray-600 tracking-wide mt-1">WORKFORCE</p>
            <span className="hidden md:block absolute right-0 top-1/2 transform -translate-y-1/2 w-px h-12 bg-orange-200"></span>
          </div>

          {/* Fourth Item */}
          <div className="text-center px-2 sm:px-4 relative">
            <h3 className="text-primary text-xl sm:text-2xl font-bold">{aboutus.tonnes_saved}</h3>
            <p className="text-xs sm:text-sm text-gray-600 tracking-wide mt-1">TONNES SAVED</p>
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

      {/* Testominical */}
      <section className="w-full py-8 sm:py-10 px-4 sm:px-6">
        <div className="max-w-6xl mx-auto">
          <div className="flex flex-col md:flex-row items-center justify-between gap-4 md:gap-0 mb-6 sm:mb-8">
            <div className="text-center md:text-left md:flex-1">
              <h2 className="text-lg sm:text-xl md:text-2xl font-bold text-gray-800">
                What Our Clients Say
              </h2>
              <p className="text-gray-700 text-xs sm:text-sm md:text-base mt-1 sm:mt-2 max-w-md mx-auto md:mx-0">
                Trusted by industry leaders for excellence and innovation
              </p>
            </div>

            {/* Navigation */}
            <div className="flex items-center gap-3 mt-2 md:mt-0">
              <button
                className="p-2 bg-gray-100 hover:bg-gray-200 rounded-full transition-colors"
                onClick={() => sliderRef.current.slickPrev()}
              >
                <FaArrowLeft size={18} className="text-gray-700" />
              </button>
              <button
                className="p-2 bg-gray-100 hover:bg-gray-200 rounded-full transition-colors"
                onClick={() => sliderRef.current.slickNext()}
              >
                <FaArrowRight size={18} className="text-gray-700" />
              </button>
            </div>
          </div>

          {/* Slider Container */}
          <div className="relative">
            <Slider ref={sliderRef} {...settings}>
              {testimonials.map((item, index) => (
                <div key={index} className="px-2 sm:px-3 focus:outline-none">
                  <div className="h-full">
                    <TestimonialCard testimonial={item} />
                  </div>
                </div>
              ))}
            </Slider>
          </div>
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
              <img src={`${API}/${partner.image}`} alt={partner.name} className=" w-full h-8 object-cover" />
              {/* <span className="text-gray-600 text-sm">{partner.name}</span> */}
            </div>
          ))}
        </div>
      </div>
    </div>
  )
}

export default Home

