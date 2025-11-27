import React, { useEffect, useState } from 'react'
import { TbPercentage } from "react-icons/tb";
import { FaClock, FaLeaf } from "react-icons/fa";
import { MdSecurity } from 'react-icons/md';
import { API, getOurExpertise, getWhyChoose } from '../api';
function Expertise() {


    const iconMap = {
        "Material Savings": <TbPercentage />,
        "Faster Construction": <FaClock />,
        "Enhanced Durability": <MdSecurity />,
        "Sustainable Design": <FaLeaf />,
    };

    const [expertise, setExpertise] = useState({});
    const [benefits, setBenefits] = useState([]);

    useEffect(() => {
        const fetchOurExpertise = async () => {
            try {
                const data = await getOurExpertise();
                console.log("Our Expertise DATA", data)
                setExpertise(data);
            } catch (error) {
                console.error('Error fetching Our Expertise:', error);
            }
        };

        fetchOurExpertise();
    }, []);


    useEffect(() => {
        const fetchWhyChoose = async () => {
            try {
                const data = await getWhyChoose();
                console.log("Our Expertise DATA", data)
                setBenefits(data);
            } catch (error) {
                console.error('Error fetching Our Expertise:', error);
            }
        };

        fetchWhyChoose();
    }, []);


    return (
        <div className='' >

            <section
                className="relative w-full h-[250px] bg-cover bg-center flex items-center"
                style={{ backgroundImage: `url(${API}/${expertise.main_image})` }}    >
                {/* Overlay (optional for darkening bg) */}
                <div className="absolute inset-0 bg-black/30"></div>

                {/* Content */}
                <div className="relative container mx-auto px-6">
                    <h2 className="text-white text-4xl font-bold border-l-4 pl-4 border-blue-500">
                        {expertise.main_title}
                    </h2>
                </div>
            </section>

            <section className="flex flex-col my-16 md:flex-row items-center justify-center gap-10 max-md:px-4">
                <div className="relative shadow-2xl shadow-indigo-600/40 rounded-2xl overflow-hidden shrink-0">
                    <img
                        className="max-w-md w-full object-cover rounded-2xl"
                        src={`${API}/${expertise.second_image}`}
                        alt=""
                    />
                </div>

                <div className="text-sm text-black max-w-lg">
                    <h1 className="text-xl uppercase font-bold ">
                        {expertise.second_title}
                    </h1>
                    <ul className="mt-8 list-disc list-inside font-semibold space-y-4">
                        {expertise.second_points?.map((point, idx) => (
                            <li key={idx}>{point}</li>
                        ))}

                    </ul>
                </div>
            </section>

            <section className="flex my-16 flex-col md:flex-row items-center justify-center gap-10 max-md:px-4">
                <div className="text-sm text-black max-w-lg">
                    <h1 className="text-xl uppercase font-bold ">
                        {expertise.third_title}
                    </h1>
                    <ul className="mt-8 list-disc list-inside font-semibold space-y-4">
                        {expertise.third_points?.map((point, idx) => (
                            <li key={idx}>{point}</li>
                        ))}

                    </ul>
                </div>

                <div className="relative shadow-2xl shadow-indigo-600/40 rounded-2xl overflow-hidden shrink-0">
                    <img
                        className="max-w-md w-full object-cover rounded-2xl"
                        src={`${API}/${expertise.third_image}`}
                        alt=""
                    />
                </div>
            </section>

            <section className="flex flex-col my-16 items-center justify-center mx-auto max-md:mx-2 max-md:px-2 max-w-5xl w-full text-center py-16 bg-slate-100/70">
                <h1 className="text-2xl md:text-3xl font-bold text-primary max-w-2xl mt-5">
                    Why Choose MM Precise?
                </h1>

                <p className="text-sm text-gray-500 max-w-lg mt-2">
                    Delivering excellence through innovation, precision, and unmatched quality.
                </p>

                <div className="flex gap-4 flex-wrap justify-center">
                    {benefits.map((item) => (
                        <div
                            key={item.id}
                            className="flex flex-col justify-center items-center px-8 py-4 mt-4 w-56 bg-white text-black hover:scale-105 transition duration-300 rounded-lg shadow-md"
                        >
                            <div className="rounded-full text-white bg-primary p-2 w-8 h-8 flex items-center justify-center">
                                {iconMap[item.title] || <TbPercentage />}
                                {/* Fallback icon */}
                            </div>
                            <h1 className="text-lg font-semibold mt-2 text-center">{item.title}</h1>
                            <p className="text-sm text-center mt-1">{item.description}</p>
                        </div>
                    ))}
                </div>
            </section>


        </div>
    )
}

export default Expertise