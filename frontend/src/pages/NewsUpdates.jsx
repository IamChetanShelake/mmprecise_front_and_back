import React, { useEffect, useState } from "react";
import { FiArrowRight } from "react-icons/fi";
import { Achievements } from '../components';
import { API, getAchievements, latestNews } from "../api";
import { useNavigate } from "react-router-dom";
function NewsUpdates() {
  const [achievements, setAchievements] = useState([]);
  const [latestNewsData, setLatestNewsData] = useState([]);
  const navigate = useNavigate();

  useEffect(() => {
    const fetchAchievements = async () => {
      try {
        const data = await getAchievements();
        setAchievements(data);
      } catch (error) {
        console.error('Error fetching achievements:', error);
      } 
    };

    const fetchLatestNews = async () => {
      try {
        const data = await latestNews();
        setLatestNewsData(data);
      } catch (error) {
        console.error('Error fetching Latest News:', error);
      } 
    };

    fetchAchievements();
    fetchLatestNews(); 
  }, []);

  // Sort achievements
  const allAchievements = achievements?.sort((a, b) => a.sort_order - b.sort_order);

  // Function to get plain text from HTML description
  const getPlainText = (htmlString) => {
    if (!htmlString) return '';
    // Remove HTML tags and convert HTML entities
    const tempDiv = document.createElement('div');
    tempDiv.innerHTML = htmlString;
    return tempDiv.textContent || tempDiv.innerText || '';
  };

  // Function to truncate text for card display
  const truncateText = (text, maxLength) => {
    if (!text) return '';
    if (text.length <= maxLength) return text;
    return text.substr(0, maxLength) + '...';
  };

  return (
    <div>
      {/* HERO SECTION */}
      <section className="container mx-auto px-6 py-12">
        <div className="flex flex-col md:flex-row items-start gap-8 max-w-7xl mx-auto">
          <div className="md:w-1/3 w-full">
            <h1 className="text-3xl font-bold uppercase leading-tight">
              Latest News & Updates
            </h1>
            <div className="bg-orange-500 h-1 w-20 mt-2"></div>
          </div>
          <div className="md:w-2/3 w-full">
            <p className="text-gray-600 text-lg leading-8">
              Stay updated with our latest achievements, project milestones,
              and industry insights shaping the future of construction.
            </p>
          </div>
        </div>

        {/* CARDS GRID */}
        <div className="grid grid-cols-1 lg:grid-cols-2 gap-6 max-w-7xl mx-auto mt-10">
          {/* LEFT BIG CARD - First news item */}
          {latestNewsData[0] && (
            <div className="rounded-xl overflow-hidden shadow-md flex flex-col">
              <img
                src={`${API}/${latestNewsData[0].main_image}`}
                alt={latestNewsData[0].main_title}
                className="w-full h-[460px] object-cover"
              />
              <div className="p-6 bg-white">
                <h3 className="text-lg font-semibold text-gray-900">
                  {latestNewsData[0].main_title}
                </h3>
                <p className="text-sm text-gray-600 mt-2">
                  {truncateText(getPlainText(latestNewsData[0].description), 150)}
                </p>
              </div>
              <div className="flex items-center justify-end m-4">
                <button 
                onClick={() => navigate(`/news-updates-details`, { state: { id: latestNewsData[0].id } })}
                className="mt-4 w-9 h-9 flex items-center justify-center rounded-full border border-gray-300 hover:bg-black hover:text-white transition">
                  <FiArrowRight />
                </button>
              </div>
            </div>
          )}

          {/* RIGHT TWO CARDS - Next two news items */}
          <div className="grid grid-rows-2 gap-6">
            {latestNewsData.slice(1, 3).map((news) => (
              <div key={news.id} className="rounded-xl overflow-hidden shadow-md">
                <img
                  src={`${API}/${news.main_image}`}
                  alt={news.main_title}
                  className="w-full h-[170px] object-cover"
                />
                <div className="p-6 bg-white">
                  <h3 className="text-lg font-semibold text-gray-900">{news.main_title}</h3>
                  <p className="text-sm text-gray-600 mt-2">
                    {truncateText(getPlainText(news.description), 120)}
                  </p>
                </div>
                <div className="flex items-center justify-end m-4">
                  <button
                   onClick={() => navigate(`/news-updates-details`, { state: { id: news.id } })}
                  className="mt-4 w-9 h-9 flex items-center justify-center rounded-full border border-gray-300 hover:bg-black hover:text-white transition">
                    <FiArrowRight />
                  </button>
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>

      <section id="achievements">
        <Achievements
          heading={"ACHIEVEMENTS"}
          achievements={allAchievements}
          showButton={false}
        />
      </section>
    </div>
  );
}

export default NewsUpdates;