import React from 'react'
import { images } from '../assets'
import { TbPercentage } from "react-icons/tb";
import { FaClock, FaLeaf } from "react-icons/fa";
import { MdSecurity } from 'react-icons/md';
import expertiseImg from '../assets/images/EXPERTISE3.png';
function Expertise() {


    const data = [
        {
            icon: <TbPercentage />,
            title: "Material Savings",
            description: "Up to 30% reduction in concrete and steel consumption through optimized design",
        }, 
        {
            icon: <FaClock />,
            title: "Faster  Construction",
            description: "Reduced construction time through efficient design and execution methodologies",
        },
        {
            icon: <MdSecurity />,
            title: "Enhanced Durability",
            description: "Superior structural integrity and longevity through advanced engineering solutions",
        },
        {
            icon: <FaLeaf />,
            title: "Sustainable Design",
            description: "Environmentally conscious engineering with focus on green building practices",
        },
    ];

    return (
        <div className='' >

            <section
                className="relative w-full h-[250px] bg-cover bg-center flex items-center"
                style={{ backgroundImage: `url(${expertiseImg})` }}    >
                {/* Overlay (optional for darkening bg) */}
                <div className="absolute inset-0 bg-black/30"></div>

                {/* Content */}
                <div className="relative container mx-auto px-6">
                    <h2 className="text-white text-4xl font-bold border-l-4 pl-4 border-blue-500">
                        OUR EXPERTISE
                    </h2>
                </div>
            </section>

            <section className="flex flex-col my-16 md:flex-row items-center justify-center gap-10 max-md:px-4">
                <div className="relative shadow-2xl shadow-indigo-600/40 rounded-2xl overflow-hidden shrink-0">
                    <img
                        className="max-w-md w-full object-cover rounded-2xl"
                        src={images.EXPERTISE1}
                        alt=""
                    />
                </div>

                <div className="text-sm text-black max-w-lg">
                    <h1 className="text-xl uppercase font-bold ">
                        Turnkey Construction Solutions
                    </h1>
                    <ul className="mt-8 list-disc list-inside font-semibold space-y-4">
                        <li>End-to-end project delivery – design to handover</li>
                        <li>Single-point accountability</li>
                        <li>Time & cost efficiency</li>
                        <li>Coordination between all stakeholders</li>
                    </ul>
                </div>
            </section>

            <section className="flex my-16 flex-col md:flex-row items-center justify-center gap-10 max-md:px-4">
                <div className="text-sm text-black max-w-lg">
                    <h1 className="text-xl uppercase font-bold ">
                        Industrial Construction
                    </h1>
                    <ul className="mt-8 list-disc list-inside font-semibold space-y-4">
                        <li>Long-span structures up to 24m</li>
                        <li>Pre-engineered buildings (PEBs)</li>
                        <li>Heavy machine foundations</li>
                        <li>Advanced slab technologies – PT, Void PT, Deck Slab</li>
                        <li>Fibre-reinforced concrete, GGBS, strength monitoring</li>
                    </ul>
                </div>

                <div className="relative shadow-2xl shadow-indigo-600/40 rounded-2xl overflow-hidden shrink-0">
                    <img
                        className="max-w-md w-full object-cover rounded-2xl"
                        src={images.EXPERTISE2}
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
                    {data.map((item, index) => (
                        <div
                            key={index}
                            className="flex flex-col justify-center items-center px-8 py-4 mt-4 w-56 bg-white text-black hover:scale-105 transition duration-300 rounded-lg shadow-md"
                        >
                            <div className="rounded-full text-white bg-primary p-2 w-8 h-8 flex items-center justify-center">
                                {item.icon}
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