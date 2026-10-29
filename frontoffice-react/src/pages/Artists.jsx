import { useEffect, useState } from "react";
import "../styles/Artists.css";
import axios from "axios";
import { Pulsar } from "ldrs/react";
import "ldrs/react/Pulsar.css";
import { createPortal } from "react-dom";
import { Navigate, useNavigate } from "react-router-dom";

export default function Artists() {
  const navigate = useNavigate();

  const [artists, setArtists] = useState([]);
  const [nextPageUrl, setNextPageUrl] = useState("");

  const [searchValue, setSearchValue] = useState("");

  const [loader, setLoader] = useState(false);
  console.log(loader);

  // useEffects
  useEffect(() => {
    setLoader(true);
    axios
      .get("/sanctum/csrf-cookie")
      .then(() => axios.post("/api/artists", null))
      .then((res) => {
        setArtists(res?.data?.data);
        if (res?.data?.next_page_url !== null) {
          setNextPageUrl(res?.data?.next_page_url);
        }
      })
      .catch((err) => console.log(err))
      .finally(() => setLoader(false));
  }, []);

  useEffect(() => {
    if (searchValue.length === 0) {
      setLoader(true);
      axios
        .get("/sanctum/csrf-cookie")
        .then(() => axios.post("/api/artists", null))
        .then((res) => {
          setArtists(res?.data?.data);
          if (res?.data?.next_page_url !== null) {
            setNextPageUrl(res?.data?.next_page_url);
          }
        })
        .catch((err) => console.log(err))
        .finally(() => setLoader(false));
    }
  }, [searchValue]);

  // functions
  async function handleShowMoreArtists() {
    try {
      setLoader(true);

      await axios
        .post(nextPageUrl, null)
        .then((res) => {
          setArtists((prev) => [...prev, ...res?.data?.data]);
          if (res?.data?.next_page_url !== null) {
            setNextPageUrl(res?.data?.next_page_url);
          } else {
            setNextPageUrl("");
          }
        })
        .catch((err) => console.log(err));
    } catch (err) {
      console.log(err);
    } finally {
      setLoader(false);
    }
  }

  async function handleSearch(e) {
    e.preventDefault();

    try {
      setLoader(true);

      await axios
        .get("/sanctum/csrf-cookie")
        .then(() => axios.post("/api/artists", { name: searchValue }))
        .then((res) => {
          const response = res.data;
          console.log(response.data);

          setArtists(response.data);
          if (response.next_page_url !== null) {
            setNextPageUrl(response.next_page_url);
          } else {
            setNextPageUrl("");
          }
        });
    } catch (err) {
      console.log(err);
    } finally {
      setLoader(false);
    }
  }

  return (
    <>
      <main id="artists-main">
        <div className="container">
          <h2 id="artists-title">tutti gli artisti</h2>

          <form id="search-bar" onSubmit={(e) => handleSearch(e)}>
            <input
              type="text"
              name="name"
              id="name"
              placeholder="Cerca artista..."
              value={searchValue}
              onChange={(e) => setSearchValue(e.target.value)}
            />
            <i className="bi bi-search" onClick={(e) => handleSearch(e)}></i>
          </form>

          <div className="artist-row">
            {artists.length !== 0 ? (
              artists?.map((artist) => (
                <div
                  className="artist-card"
                  key={artist.id}
                  onClick={() => navigate(`/artists/${artist.slug}`)}
                >
                  <img src={artist.image_url} alt={`cover_${artist.slug}`} />
                  <div className="artist-hover">
                    <p className="artist-name">{artist.name}</p>
                    <i className="bi bi-arrow-up-right"></i>
                  </div>
                </div>
              ))
            ) : (
              <span className="empty-artists">
                <i class="bi bi-emoji-tear-fill"></i> Nessun artista trovato
              </span>
            )}
          </div>

          {nextPageUrl && (
            <div
              className="trap-italy-button load-more-button"
              onClick={handleShowMoreArtists}
            >
              <p>load more</p>
              <i className="bi bi-arrow-clockwise"></i>
            </div>
          )}
        </div>

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
