
import { CgArrowTopRight } from 'react-icons/cg';

const Achievements = ({ heading, subheading, achievements, showButton }) => {
  return (
    <section className="text-center max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
      <h2 className="text-2xl font-bold text-gray-800 uppercase">{heading}</h2>
      <p className="text-[#1e1e1e] mb-8 mt-2">{subheading}</p>

      <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto px-4">
        {achievements.map((award, index) => (
          <div key={index} className="bg-white overflow-hidden hover:scale-105 transition-transform">
            <img src={award.img} alt={award.title} className="w-full h-40 object-cover" />
            <div className="p-4 text-start">
              <h3 className="text-sm font-semibold text-black">{award.title}</h3>
              <p className="text-gray-500 text-sm mt-2">{award.description}</p>
            </div>
          </div>
        ))}
      </div>

      {/* Button Only If showButton is true */}
      {showButton && (
        <div className="text-center mt-8">
          <button className="px-6 py-3 bg-yellow-400 rounded-full text-sm font-semibold hover:bg-yellow-500 transition flex items-center mx-auto gap-2">
            VIEW ALL ACHIEVEMENTS
            <CgArrowTopRight className="w-5 h-5" />
          </button>
        </div>
      )}
    </section>
  );
};


export default Achievements;

