import React, { useEffect, useState } from "react";
import { API, getMedia } from "../api";

function MediaCoverage() {
  const [media, setMedia] = useState([]);

  useEffect(() => {
    const fetchMedia = async () => {
      try {
        const data = await getMedia();
        setMedia(data);
      } catch (error) {
        console.error('Error fetching Media:', error);
      }
    };

    fetchMedia();
  }, []);

  const allMedia = media?.sort((a, b) => a.sort_order - b.sort_order);

  // Filter by type
  const imageMedia = allMedia?.filter((item) => item.type === "image");
  const videoMedia = allMedia?.filter((item) => item.type === "video");




  return (
    <div>
      {/* HERO SECTION */}
      <section className="container mx-auto px-6 py-12 max-w-7xl">
        <div className="flex flex-col md:flex-row items-start gap-8">
          <div className="md:w-1/3 w-full">
            <h1 className="text-3xl font-bold uppercase leading-tight">
              Media Coverage
            </h1>
            <div className="bg-orange-500 h-1 w-20 mt-2"></div>
          </div>
          <div className="md:w-2/3 w-full">
            <p className="text-gray-600 text-lg leading-8">
              Stay updated with our latest achievements, project milestones, and
              industry insights shaping the future of construction.
            </p>
          </div>
        </div>
      </section>

      {/* IMAGES SECTION */}
      <section className="container mx-auto max-w-7xl px-6 pb-12">
        <h1 className="text-3xl font-semibold text-center md:text-start">Images</h1>

        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 pt-8">
          {imageMedia.map((item) => (
            <div key={item.id} className="hover:-translate-y-1 transition duration-300">
              <img
                className="rounded-xl w-full h-48 object-cover"
                src={`${API}/${item.image}`}
                alt={item.title}
              />
              <h3 className="text-base text-slate-900 font-semibold mt-3">
                {item.title || "Media Image"}
              </h3>
            </div>
          ))}
        </div>
      </section>


      {/* VIDEOS SECTION */}
      <section className="container mx-auto max-w-7xl px-6 pb-12">
        <h1 className="text-3xl font-semibold text-center md:text-start">Videos</h1>

        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 pt-8">
          {videoMedia.map((item) => (
           <div
  key={item.id}
  className="relative hover:-translate-y-1 transition duration-300 group"
>
  {/* Video Thumbnail */}
  <img
    className="rounded-xl w-full h-48 object-cover"
    src={`${API}/${item.image}`}
    alt={item.title}
  />

  {/* Overlay + Play Button (only visible on hover) */}
  <a
    href={item.video_url}
    target="_blank"
    rel="noopener noreferrer"
    className="absolute inset-0 bg-black/50 rounded-xl flex items-center justify-center opacity-100 transition-all duration-300"
  >
    <div className="bg-white w-12 h-12 rounded-full flex items-center justify-center shadow-lg">
      <span className="text-black text-xl font-bold">▶</span>
    </div>
  </a>

  {/* Title */}
  <h3 className="text-base text-slate-900 font-semibold mt-3">
    {item.title || "Video Highlight"}
  </h3>
</div>

          ))}
        </div>
      </section>

    </div>
  );
}

export default MediaCoverage;
