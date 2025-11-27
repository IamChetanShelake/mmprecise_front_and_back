import React, { useEffect, useState } from 'react';
import { FaClock, FaExclamation, FaPhone, FaPhoneVolume, FaUser } from "react-icons/fa";
import { FaLocationDot } from 'react-icons/fa6';
import { IoIosMailOpen, IoMdMail, IoMdPricetag } from 'react-icons/io';
import { IoChatbubbleSharp } from 'react-icons/io5';
import { LiaCertificateSolid } from 'react-icons/lia';
import { MdSecurity } from 'react-icons/md';
import { getInTouchAPI, getOfficeTime } from '../api';

export default function Contact() {

    const iconMap = {
        "CALL US DIRECTLY": <FaPhoneVolume />,
        "EMAIL US": <IoIosMailOpen />,
        "VISIT OUR OFFICE": <FaLocationDot />,
    };

    const [getInTouch, setGetInTouch] = useState([]);
    const [officeTime, setOfficeTime] = useState({});


    useEffect(() => {
        const fetchgetInTouch = async () => {
            try {
                const data = await getInTouchAPI();
                console.log("Our Expertise DATA", data)
                setGetInTouch(data);
            } catch (error) {
                console.error('Error fetching Our Expertise:', error);
            }
        };

        fetchgetInTouch();
    }, []);

    useEffect(() => {
    const fetchOfficeTime = async () => {
        try {
            const data = await getOfficeTime();
            console.log("Office Time DATA", data);
            setOfficeTime(data);
        } catch (error) {
            console.error("Error fetching Office Time:", error);
        }
    };

    fetchOfficeTime();
}, []);


    const formatTime = (time) => {
        if (!time) return "—";
        const [hour, minute] = time.split(":");
        const date = new Date();
        date.setHours(hour, minute);
        return date.toLocaleTimeString([], { hour: "numeric", minute: "2-digit" });
    };


   const businessHours = [
    {
        label: "Monday - Friday",
        from: officeTime.monday_from,
        to: officeTime.friday_to,
    },
    {
        label: "Saturday",
        from: officeTime.saturday_status === "open" ? officeTime.saturday_from : null,
        to: officeTime.saturday_status === "open" ? officeTime.saturday_to : null,
        status: officeTime.saturday_status,
    },
    {
        label: "Sunday",
        from: officeTime.sunday_from,
        to: officeTime.sunday_to,
        status: officeTime.sunday_status,
    },
];



    return (
        <div className="">
            {/* Hero Section */}
            <section className="bg-gradient-to-br from-[#F37021] to-[#2C2C2C] text-white py-20 px-4 sm:px-6 lg:px-8">
                <div className="max-w-7xl mx-auto">
                    <div className="flex flex-col lg:flex-row justify-between items-center gap-12 lg:gap-8">
                        {/* Left Content */}
                        <div className="w-full lg:w-1/2 max-w-2xl">
                            <button className="bg-white/10 backdrop-blur-sm p-4 text-white px-6 py-3 rounded-full mb-6 font-semibold hover:bg-gray-100 transition-colors duration-200">
                                GET IN TOUCH
                            </button>
                            <h1 className="text-5xl lg:text-5xl font-bold leading-tight">
                                LET'S BUILD SOMETHING <span className="text-yellow-300">AMAZING</span> TOGETHER
                            </h1>

                            <p className="mt-6 text-lg text-gray-100 leading-relaxed">
                                Ready to turn your construction vision into reality? Our expert team is here to help you with innovative structural solutions and unparalleled engineering expertise.
                            </p>

                            {/* Contact Info */}
                            <div className="flex flex-col sm:flex-row gap-4 mt-8">
                                <div className="flex items-center bg-white/10 backdrop-blur-sm p-4 rounded-lg">
                                    <div className="bg-white/20 p-3 rounded-full mr-4">
                                        <FaPhone className='w-5 h-5' />
                                    </div>
                                    <div className="flex flex-col">
                                        <span className='uppercase font-semibold text-sm'>Call US</span>
                                        <span className="truncate">+91 9096879903</span>
                                    </div>
                                </div>
                                <div className="flex items-center bg-white/10 backdrop-blur-sm p-4 rounded-lg">
                                    <div className="bg-white/20 p-3 rounded-full mr-4">
                                        <IoMdMail className='w-5 h-5' />
                                    </div>
                                    <div className="flex flex-col">
                                        <span className='uppercase font-semibold text-sm'>Email US</span>
                                        <span className="truncate">info@mmptce.com</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {/* Right Form */}
                        <div className="w-full lg:w-1/2 max-w-lg">
                            <form className="bg-white text-black shadow-xl rounded-2xl p-6 lg:p-8">
                                {/* Name and Email in row on larger screens */}
                                <div className="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    {/* Full Name Field */}
                                    <div>
                                        <label htmlFor="fullName" className='flex items-center gap-2 mb-2 text-sm font-medium'>
                                            <FaUser className="text-orange-500 w-4 h-4" />
                                            Full Name *
                                        </label>
                                        <input
                                            id="fullName"
                                            name="fullName"
                                            type="text"
                                            className="w-full border border-gray-300 focus:outline-orange-500 focus:border-orange-500 px-4 py-3 rounded-lg transition-colors duration-200"
                                            placeholder="Your full name"
                                            required
                                        />
                                    </div>

                                    {/* Email Field */}
                                    <div>
                                        <label htmlFor="email" className='flex items-center gap-2 mb-2 text-sm font-medium'>
                                            <IoMdMail className="text-orange-500 w-4 h-4" />
                                            Email Address *
                                        </label>
                                        <input
                                            id="email"
                                            name="email"
                                            type="email"
                                            className="w-full border border-gray-300 focus:outline-orange-500 focus:border-orange-500 px-4 py-3 rounded-lg transition-colors duration-200"
                                            placeholder="Your email address"
                                            required
                                        />
                                    </div>
                                </div>

                                {/* Subject Field */}
                                <div className="mb-6">
                                    <label htmlFor="subject" className='flex items-center gap-2 mb-2 text-sm font-medium'>
                                        <IoMdPricetag className="text-orange-500 w-4 h-4" />
                                        Subject *
                                    </label>
                                    <input
                                        id="subject"
                                        name="subject"
                                        type="text"
                                        className="w-full border border-gray-300 focus:outline-orange-500 focus:border-orange-500 px-4 py-3 rounded-lg transition-colors duration-200"
                                        placeholder="Message subject"
                                        required
                                    />
                                </div>

                                {/* Message Field */}
                                <div className="mb-6">
                                    <label htmlFor="message" className='flex items-center gap-2 mb-2 text-sm font-medium'>
                                        <IoChatbubbleSharp className="text-orange-500 w-4 h-4" />
                                        Message *
                                    </label>
                                    <textarea
                                        id="message"
                                        name="message"
                                        className="w-full border border-gray-300 focus:outline-orange-500 focus:border-orange-500 px-4 py-3 rounded-lg transition-colors duration-200 resize-none"
                                        rows="4"
                                        placeholder="Your message here..."
                                        required
                                    ></textarea>
                                </div>

                                {/* Submit Button */}
                                <button
                                    type="submit"
                                    className="bg-orange-500 hover:bg-orange-600 text-white px-6 py-4 rounded-lg w-full font-semibold transition-all duration-200 transform hover:scale-105"
                                >
                                    Send Message
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </section>

            {/* Contact Options */}
            <section className="py-16 bg-gray-50">
                <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    {/* Header Section */}
                    <div className="text-center max-w-3xl mx-auto">
                        <h2 className="text-orange-500 font-semibold mb-3 tracking-wide">REACH OUT TO US</h2>
                        <h3 className="text-4xl lg:text-5xl font-bold text-gray-900 mb-4">GET IN TOUCH</h3>
                        <p className="text-lg text-gray-600 leading-relaxed">
                            Multiple ways to connect with our expert construction team
                        </p>
                    </div>

                    {/* Contact Cards Grid */}
                    <div className="grid grid-cols-1 md:grid-cols-3 gap-8 mt-12">
                        {getInTouch.map((item) => (
                            <div
                                key={item.id}
                                className="bg-white border border-gray-200 rounded-xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1"
                            >
                                {/* Icon */}
                                <div className="bg-gradient-to-br from-[#F97316] to-[#EA580C] w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                                    <span className="text-2xl text-white">
                                        {iconMap[item.title]}
                                    </span>
                                </div>

                                {/* Title */}
                                <h4 className="font-bold text-center text-xl text-gray-900 mb-3">
                                    {item.title}
                                </h4>

                                {/* Description */}
                                <p className="text-gray-600 text-center leading-relaxed mb-6">
                                    {item.description}
                                </p>

                                {/* Button Logic */}
                                {item.contact_type === "call" && (
                                    <a
                                        href={`tel:${item.phone}`}
                                        className="bg-gradient-to-br from-[#F97316] to-[#EA580C] text-white px-6 py-3 rounded-full font-semibold transition-all duration-200 transform hover:scale-105 w-full block text-center"
                                    >
                                        {item.phone}
                                    </a>
                                )}

                                {item.contact_type === "email" && (
                                    <a
                                        href={`mailto:${item.email}`}
                                        className="bg-gradient-to-br from-[#EA580C] to-[#DC2626] text-white px-6 py-3 rounded-full font-semibold transition-all duration-200 transform hover:scale-105 w-full block text-center"
                                    >
                                        {item.email}
                                    </a>
                                )}

                                {item.contact_type === "visit" && (
                                    <button
                                        className="bg-gradient-to-br from-[#DC2626] to-[#B91C1C] text-white px-6 py-3 rounded-full font-semibold transition-all duration-200 transform hover:scale-105 w-full"
                                        onClick={() =>
                                            window.open(
                                                `https://www.google.com/maps/search/?api=1&query=${encodeURIComponent(item.address)}`,
                                                "_blank"
                                            )
                                        }
                                    >
                                        Get Directions
                                    </button>
                                )}
                            </div>
                        ))}
                    </div>
                </div>
            </section>

            {/* Map */}


            {/* Why Choose & Business Hours */}
            <section className="py-16 bg-white">
                <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div className="grid md:grid-cols-2 gap-8">
                        {/* Why Choose MM Precise Card */}
                        <div className="bg-white border border-gray-200 rounded-xl p-8 shadow-lg hover:shadow-xl transition-all duration-300">
                            <h4 className="text-orange-500 font-bold text-2xl mb-6">WHY CHOOSE MM PRECISE?</h4>
                            <div className="space-y-4 text-gray-700">
                                {/* Certified Excellence */}
                                <div className="flex items-start gap-4">
                                    <div className="w-14 h-14 p-2 bg-gradient-to-br from-[#F97316] to-[#EA580C] rounded-lg flex items-center justify-center">
                                        <LiaCertificateSolid className="w-8 h-6 text-white" />
                                    </div>
                                    <div>
                                        <h3 className="text-base font-semibold uppercase text-slate-900">
                                            Certified Excellence
                                        </h3>
                                        <p className="text-sm text-slate-500">
                                            ISO certified company with proven track record of delivering exceptional construction results.
                                        </p>
                                    </div>
                                </div>

                                {/* Timely Delivery */}
                                <div className="flex items-start gap-4">
                                    <div className="w-14 h-14 p-2 bg-gradient-to-br from-[#EA580C] to-[#DC2626] rounded-lg flex items-center justify-center">
                                        <FaClock className="w-8 h-6 text-white" />
                                    </div>
                                    <div>
                                        <h3 className="text-base font-semibold uppercase text-slate-900">
                                            Timely Delivery
                                        </h3>
                                        <p className="text-sm text-slate-500">
                                            99% on-time project completion rate with strict adherence to construction schedules.
                                        </p>
                                    </div>
                                </div>

                                {/* Quality Assurance */}
                                <div className="flex items-start gap-4">
                                    <div className="w-14 h-14 p-2 bg-gradient-to-br from-[#DC2626] to-[#B91C1C] rounded-lg flex items-center justify-center">
                                        <MdSecurity className="w-8 h-6 text-white" />
                                    </div>
                                    <div>
                                        <h3 className="text-base font-semibold uppercase text-slate-900">
                                            Quality Assurance
                                        </h3>
                                        <p className="text-sm text-slate-500">
                                            Rigorous quality control processes ensure every construction project meets international standards.
                                        </p>
                                    </div>
                                </div>
                            </div>

                        </div>

                        {/* Business Hours Card */}
                        <div className="bg-white border border-gray-200 rounded-xl p-8 shadow-lg hover:shadow-xl transition-all duration-300">
                            <h4 className="text-orange-500 font-bold text-2xl mb-6">BUSINESS HOURS</h4>
                            <div className="space-y-4 text-gray-700 mb-6">
                                {businessHours.map((day, index) => (
                                    <div
                                        key={index}
                                        className={`flex justify-between items-center ${index !== businessHours.length - 1 ? "pb-3 border-b border-gray-100" : ""
                                            }`}
                                    >
                                        <strong className="text-gray-900 font-semibold">{day.label}:</strong>

                                        {day.status === "closed" ? (
                                            <span className="text-red-500 font-semibold">Closed</span>
                                        ) : (
                                            <span className="text-primary font-semibold">
                                                {formatTime(day.from)} - {formatTime(day.to)}
                                            </span>
                                        )}
                                    </div>
                                ))}
                            </div>

                            <div className="bg-yellow-50 border border-yellow-200 p-4 rounded-lg text-sm flex items-start gap-3">
                                <div className="bg-yellow-100 w-6 h-6 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <span className="text-yellow-600"><FaExclamation /></span>
                                </div>
                                <div>
                                    <h1 className="text-sm font-semibold text-gray-900">Emergency Support</h1>
                                    <p className="text-sm font-semibold text-gray-600">
                                        For urgent construction project requirements or technical emergencies, call us 24/7 at our emergency hotline.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    );
}
