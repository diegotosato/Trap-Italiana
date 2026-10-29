import { useEffect, useState } from "react";
import "../styles/FocusArtist.css";
import { useNavigate, useParams } from "react-router-dom";
import axios from "axios";
import { Pulsar } from "ldrs/react";
import "ldrs/react/Pulsar.css";
import { createPortal } from "react-dom";

export default function FocusArtist() {
  const navigate = useNavigate();

  const { slug } = useParams();

  const [artist, setArtists] = useState(null);
  const [loader, setLoader] = useState(false);

  useEffect(() => {
    setLoader(true);
    axios
      .get("/sanctum/csrf-cookie")
      .then(
        axios
          .get(`/api/artists/${slug}`)
          .then((res) => {
            const response = res.data;
            setArtists(response);
          })
          .catch((err) => console.log(err))
          .finally(() => setLoader(false)),
      )
      .catch((err) => {
        console.log(err);
        setLoader(false);
      });
  }, []);

  console.log(slug);
  console.log(artist);

  return (
    <>
      <main id="focus-artist-main">
        {!loader && artist && (
          <div className="container">
            <div>
              <span className="turn-back" onClick={() => navigate("/artists")}>
                <i className="bi bi-arrow-left"></i> Torna agli artisti
              </span>
            </div>

            <div className="focus-grid">
              <div className="left-grid">
                <div className="artist-infos">
                  <div className="artist-image">
                    <img src={artist.artist_image} alt={`${slug}-cover`} />
                  </div>

                  <div className="artist-texts">
                    <h1>{artist.artist_name}</h1>

                    <p>{artist.description}</p>
                  </div>
                </div>

                <div className="artist-albums">
                  <h2>album pubblicati</h2>

                  <div className="albums-grid">
                    {artist.artist_albums.map((album) => (
                      <div className="album-card">
                        <img src={album.image} alt={album.name} />
                        <p>{album.name}</p>
                      </div>
                    ))}
                  </div>
                </div>
              </div>

              <div className="right-grid">
                <iframe
                  id="artist-frame"
                  data-testid="embed-iframe"
                  src={`https://open.spotify.com/embed/artist/${artist.artist_spotify_ID}?utm_source=generator&theme=0`}
                  allowFullScreen=""
                  allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture"
                  loading="lazy"
                  frameBorder="0"
                ></iframe>
              </div>
            </div>
          </div>
        )}
        {loader &&
          createPortal(
            <div className="loader">
              <Pulsar size="40" speed="1.75" color="#7026e0" />
            </div>,
            document.body,
          )}
      </main>
    </>
  );
}
