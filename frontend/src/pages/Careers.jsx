import React, { useEffect, useState } from "react";
import { icons, images } from "../assets";
import { getCareers } from "../api";

const Careers = () => {

    const [careers, setCareers] = useState([]);

    useEffect(() => {
        const fetchCareers = async () => {
            try {
                const data = await getCareers();
                console.log("Our Expertise DATA", data)
                setCareers(data);
            } catch (error) {
                console.error('Error fetching Our Expertise:', error);
            }
        };

        fetchCareers();
    }, []);

    const [searchQuery, setSearchQuery] = useState("");

    const filteredCareers = careers.filter((job) =>
        job.role.toLowerCase().includes(searchQuery.toLowerCase()) ||
        job.responsibilities.toLowerCase().includes(searchQuery.toLowerCase()) ||
        job.location.toLowerCase().includes(searchQuery.toLowerCase())
    );


    return (
        <div className="">
            {/* Hero Section */}
            <section className="container mx-auto px-6 py-12">
                <div className="flex flex-col items-center gap-10 max-w-7xl">
                    <div className="flex flex-col md:flex-row md:items-start gap-6">
                        <div className="w-full md:w-1/3">
                            <h1 className="text-3xl font-bold leading-tight relative">
                                MEET THE TEAM WORK BEHIND OUR SUCCESS
                                <div className="bg-orange-500 h-1 w-20 mt-2"></div>
                            </h1>
                        </div>
                        <div className="w-full md:w-2/3">
                            <p className="text-gray-600 text-[18px] md:text-[20px] leading-8">
                                Build your future with us. Great projects are built by great people - and
                                we invest in them. Join us to grow, innovate, and shape stronger
                                communities and lasting landmarks.
                            </p>
                        </div>
                    </div>

                    <div>
                        <img
                            src={images.careers1}
                            alt="Team at work"
                            className="shadow-md w-full mx-auto"
                        />
                    </div>
                </div>
            </section>


            {/* Open Positions Section */}
            <section className="py-10">
  <div className="container mx-auto px-4 sm:px-6">
    {/* Header and Search */}
    <div className="flex flex-col md:flex-row items-center justify-between gap-4 relative">
      <h2 className="text-xl sm:text-2xl font-semibold text-center md:text-left">
        Currently Open Positions
      </h2>

      <div className="flex items-center border border-gray-500/30 rounded-full h-[42px] sm:h-[46px] w-full max-w-xs sm:max-w-sm md:max-w-xs px-4">
        <input
          type="text"
          placeholder="Search"
          value={searchQuery}
          onChange={(e) => setSearchQuery(e.target.value)}
          className="w-full text-sm bg-transparent outline-none text-gray-600 placeholder-gray-500"
        />
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="20"
          height="20"
          viewBox="0 0 30 30"
          fill="#6B7280"
        >
          <path d="M13 3C7.489 3 3 7.489 3 13s4.489 10 10 10a9.95 9.95 0 0 0 6.322-2.264l5.971 5.971a1 1 0 1 0 1.414-1.414l-5.97-5.97A9.95 9.95 0 0 0 23 13c0-5.511-4.489-10-10-10m0 2c4.43 0 8 3.57 8 8s-3.57 8-8 8-8-3.57-8-8 3.57-8 8-8" />
        </svg>
      </div>
    </div>

    {/* Jobs Grid */}
    <div className="mt-8 grid grid-cols-1 sm:grid-cols-2 gap-6 md:gap-10">
      {filteredCareers.length > 0 ? (
        filteredCareers.map((job) => (
          <div
            key={job.id}
            className="p-5 sm:p-6 rounded-lg shadow-sm border border-gray-200 hover:shadow-md transition-shadow"
          >
            <h3 className="text-lg sm:text-xl font-semibold mb-3">{job.role}</h3>

            <div className="flex gap-2 items-start mb-2">
              <img src={icons.idea} alt="skills" className="w-4 h-4 sm:w-5 sm:h-5 mt-1" />
              <p className="text-gray-600 text-sm">{job.skills.join(", ")}</p>
            </div>

            <div className="flex gap-2 items-start mb-4">
              <img src={icons.work} alt="responsibilities" className="w-4 h-4 sm:w-5 sm:h-5 mt-1" />
              <p className="text-gray-600 text-sm whitespace-pre-line">{job.responsibilities}</p>
            </div>

            <div className="flex flex-wrap gap-4 text-sm text-gray-500">
              <div className="flex items-center gap-1">
                <img src={icons.location} alt="location" className="w-4 h-4" />
                <span>{job.location}</span>
              </div>

              <div className="flex items-center gap-1">
                <img src={icons.workOutline} alt="experience" className="w-4 h-4" />
                <span>{job.years_experience}</span>
              </div>
            </div>
          </div>
        ))
      ) : (
        <p className="text-gray-500 text-center sm:text-left col-span-full">
          No jobs found for your search.
        </p>
      )}
    </div>
  </div>
</section>


            {/* Join Form Section */}
            <section className="container mx-auto px-6 py-12">
                <h2 className="text-2xl font-semibold text-center mb-4">JOIN MM PRECISE</h2>
                <p className="text-center text-gray-600 mb-8">
                    Please fill in the details below, and our team will get in touch with you shortly.
                </p>

                <div className="flex flex-col md:flex-row gap-10">
                    <div className="md:w-1/2">
                        <img
                            src={images.careers2}
                            alt="Blueprints"
                            className="rounded-xl shadow-md"
                        />
                    </div>

                    <form className="md:w-1/2 bg-white p-8 border-none rounded-lg shadow-md space-y-4">
                        {/* Text Inputs */}
                        <input
                            type="text"
                            placeholder="Enter Full Name*"
                            className="w-full border rounded-lg px-3 py-2 outline-none"
                            required
                        />
                        <input
                            type="email"
                            placeholder="Email Address*"
                            className="w-full border rounded-lg px-3 py-2 outline-none"
                            required
                        />
                        <input
                            type="tel"
                            placeholder="Phone Number*"
                            className="w-full border rounded-lg px-3 py-2 outline-none"
                            required
                        />
                        <input
                            type="text"
                            placeholder="Current Location*"
                            className="w-full border rounded-lg px-3 py-2 outline-none"
                            required
                        />

                        {/* File Upload */}
                        <label className="flex flex-col w-full border rounded-md p-1 cursor-pointer hover:border-primary transition">

                            <input
                                type="file"
                                accept="application/pdf"
                                className="text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:border-0 file:bg-primary file:text-white file:rounded-md "
                                required
                                placeholder="Upload Resume (PDF Only)*"
                            />
                        </label>

                        {/* Confirmation */}
                        <label className="flex items-center text-sm">
                            <input type="checkbox" className="mr-2 w-4 h-4 accent-primary" required />
                            I confirm that the information provided is accurate.
                        </label>

                        {/* Submit Button */}
                        <button
                            type="submit"
                            className="w-full bg-primary hover:bg-orange-600 text-white rounded-md py-2 transition"
                        >
                            Submit
                        </button>
                    </form>

                </div>
            </section>
        </div>
    );
};

export default Careers;
