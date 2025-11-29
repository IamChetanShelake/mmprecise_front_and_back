import React, { useEffect, useState } from 'react';
import { useLocation, useNavigate } from 'react-router-dom';
import { FiArrowRight } from 'react-icons/fi';
import { API, News, latestNews } from '../api';

export default function NewsUpdatesDetails() {
    const [newsDetails, setNewsDetails] = useState(null);
    const [allLatestNews, setAllLatestNews] = useState([]);
    const [loading, setLoading] = useState(true);
    const location = useLocation();
    const navigate = useNavigate();
    const newsId = location.state?.id;

    // Function to get plain text from HTML description
    const getPlainText = (htmlString) => {
        if (!htmlString) return '';
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

    // Handle navigation to news details
    const handleNewsClick = (newsId) => {
        navigate('/news-updates-details', { state: { id: newsId } });
        // Reload the page to fetch new data
        window.location.reload();
    };

    useEffect(() => {
        const fetchNewsData = async () => {
            try {
                setLoading(true);
                // Fetch specific news details
                if (newsId) {
                    const newsData = await News(newsId);
                    setNewsDetails(newsData);
                }
                // Fetch all latest news for sidebar
                const allNews = await latestNews();
                setAllLatestNews(allNews);
            } catch (error) {
                console.error('Error fetching news:', error);
            } finally {
                setLoading(false);
            }
        };

        fetchNewsData();
    }, [newsId]);

    if (loading) {
        return <div className="text-center py-12">Loading...</div>;
    }

    // Filter out the current news from the sidebar list
    const sidebarNews = allLatestNews.filter(news => news.id !== newsId);

    return (
        <div className="max-w-7xl mx-auto p-6">
            {/* HERO SECTION */}
            <section className="container mx-auto px-6 py-12">
                <div className="flex flex-col md:flex-row items-start gap-8 max-w-8xl mx-auto">
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
            </section>

            <div className="grid grid-cols-1 lg:grid-cols-3 gap-6">
                {/* LEFT SIDE - News Details */}
                <div className="lg:col-span-2 space-y-6">
                    {newsDetails ? (
                        <>
                            <img 
                                src={`${API}/${newsDetails.main_image}`} 
                                alt={newsDetails.main_title} 
                                className="w-full rounded-2xl shadow" 
                            />
                            <div>
                                <h3 className="text-xl font-semibold mb-2">{newsDetails.main_title}</h3>
                                <div 
                                    className="text-gray-700 mb-4 prose max-w-none"
                                    dangerouslySetInnerHTML={{ __html: newsDetails.description }}
                                />
                                
                                {newsDetails.key_highlights && newsDetails.key_highlights.length > 0 && (
                                    <ul className="list-disc pl-5 text-gray-700 space-y-1 mb-4">
                                        {newsDetails.key_highlights.map((highlight, index) => (
                                            <li key={index}>{highlight}</li>
                                        ))}
                                    </ul>
                                )}
                                
                                {newsDetails.news_quote_description && (
                                    <blockquote className="border-l-4 border-orange-500 pl-4 italic text-gray-600">
                                        {newsDetails.news_quote_description}
                                        {newsDetails.news_feedbacker && (
                                            <span className="block not-italic font-semibold mt-2">— {newsDetails.news_feedbacker}</span>
                                        )}
                                    </blockquote>
                                )}

                                {newsDetails.last_description && (
                                    <div className="mt-4 text-gray-700">
                                        {newsDetails.last_description}
                                    </div>
                                )}
                            </div>
                        </>
                    ) : (
                        <div className="text-center py-12">
                            <p className="text-gray-600">No news details found.</p>
                        </div>
                    )}
                </div>

                {/* RIGHT SIDE - Other News */}
                <div className="space-y-6">
                    {sidebarNews.map((news) => (
                        <div key={news.id} className="rounded-2xl shadow p-4 border-0">
                            <img 
                                src={`${API}/${news.main_image}`} 
                                alt={news.main_title} 
                                className="w-full rounded-xl mb-2 h-40 object-cover"
                            />
                            <div className="flex items-center justify-between">
                                <h4 className="font-semibold">{news.main_title}</h4>
                                <button 
                                    className="mt-4 w-9 h-9 flex items-center justify-center rounded-full border border-gray-300 hover:bg-black hover:text-white transition"
                                    onClick={() => handleNewsClick(news.id)}
                                >
                                    <FiArrowRight />
                                </button>
                            </div>
                            <p className="text-gray-600 text-sm mt-2">
                                {truncateText(getPlainText(news.description), 100)}
                            </p>
                        </div>
                    ))}
                    
                    {/* Show message if no other news available */}
                    {sidebarNews.length === 0 && (
                        <div className="text-center py-8 text-gray-500">
                            No other news available
                        </div>
                    )}
                </div>
            </div>
        </div>
    );
}