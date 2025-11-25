import React from "react";

function MediaCoverage() {
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
        <h1 className="text-3xl font-semibold text-center md:text-start">
          Images
        </h1>

        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 pt-8">
          {[
            "https://images.unsplash.com/photo-1590650516494-0c8e4a4dd67e?w=1200&h=800&auto=format&fit=crop&q=60",
            "https://images.unsplash.com/photo-1714974528646-ea024a3db7a7?w=1200&h=800&auto=format&fit=crop&q=60",
            "https://images.unsplash.com/photo-1713947501966-34897f21162e?w=1200&h=800&auto=format&fit=crop&q=60",
            "https://images.unsplash.com/photo-1590650516494-0c8e4a4dd67e?w=1200&h=800&auto=format&fit=crop&q=60",
            "https://images.unsplash.com/photo-1714974528646-ea024a3db7a7?w=1200&h=800&auto=format&fit=crop&q=60",
            "https://images.unsplash.com/photo-1713947501966-34897f21162e?w=1200&h=800&auto=format&fit=crop&q=60",
          ].map((url, i) => (
            <div
              key={i}
              className="hover:-translate-y-1 transition duration-300"
            >
              <img
                className="rounded-xl w-full h-48 object-cover"
                src={url}
                alt={`Media Image ${i + 1}`}
              />
              <h3 className="text-base text-slate-900 font-semibold mt-3">
                Lorem ipsum dolor sit amet consectetur adipiscing elit.
              </h3>

            </div>
          ))}
        </div>
      </section>

      {/* VIDEOS SECTION */}
      <section className="container mx-auto max-w-7xl px-6 pb-12">
        <h1 className="text-3xl font-semibold text-center md:text-start">
          Videos
        </h1>

        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 pt-8">
          {[
            "https://images.unsplash.com/photo-1590650516494-0c8e4a4dd67e?w=1200&h=800&auto=format&fit=crop&q=60",
            "https://images.unsplash.com/photo-1714974528646-ea024a3db7a7?w=1200&h=800&auto=format&fit=crop&q=60",
            "https://images.unsplash.com/photo-1713947501966-34897f21162e?w=1200&h=800&auto=format&fit=crop&q=60",
          ].map((url, i) => (
            <div
              key={i}
              className="hover:-translate-y-1 transition duration-300"
            >
              <img
                className="rounded-xl w-full h-48 object-cover"
                src={url}
                alt={`Video Thumbnail ${i + 1}`}
              />
              <h3 className="text-base text-slate-900 font-semibold mt-3">
                Lorem ipsum dolor sit amet consectetur adipiscing elit.
              </h3>

            </div>
          ))}
        </div>
      </section>
    </div>
  );
}

export default MediaCoverage;
