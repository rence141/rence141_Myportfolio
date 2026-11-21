// Favourite songs for the hidden "easter egg" player under the welcome board.
// The video itself is never shown: only its audio plays, and the pixel board
// displays the lyric lines. `t` is the second at which a line starts.
// Lyrics are drawn with a pixel font that supports Japanese.
export type LyricLine = { t: number; text: string };
export type Song = {
  title: string;
  artist: string;
  duration?: number;
  youtubeId?: string; // the part after v= in the YouTube URL
  videoUrl?: string; // official YouTube music video URL
  artistChannelUrl?: string; // official artist YouTube channel URL
  src?: string; // or a local file under /public, e.g. "/ims/song1.mp4"
  lines: LyricLine[];
};

export const songs: Song[] = [
  {
    title: "Inferno",
    artist: "Mrs. GREEN APPLE",
    duration: 221,
    videoUrl: "https://www.youtube.com/watch?v=wfCcs0vLysk",
    artistChannelUrl: "https://www.youtube.com/@MrsGREENAPPLE_Official",
    src: "/ims/song1.mp4",
    // Add lyric lines like { t: 12, text: "First line" } (t = start second, max ~16 chars per piece).
    lines: [],
  },
  {
    title: "Hitchcock",
    artist: "Yorushika",
    duration: 229,
    videoUrl: "https://www.youtube.com/watch?v=t7MBzMP4OzY",
    artistChannelUrl: "https://www.youtube.com/@nbuna",
    src: "/ims/song2.mp4",
    lines: [],
  },
  {
    title: "KICK BACK",
    artist: "Kenshi Yonezu",
    duration: 227,
    videoUrl: "https://www.youtube.com/watch?v=M2cckDmNLMI",
    artistChannelUrl: "https://www.youtube.com/@KenshiYonezu",
    src: "/ims/song3.mp4",
    lines: [],
  },
  {
    title: "あぶく",
    artist: "Yorushika",
    duration: 235,
    videoUrl: "https://www.youtube.com/watch?v=OHAjc-ayhus",
    artistChannelUrl: "https://www.youtube.com/@nbuna",
    src: "/ims/song4-by-n-buna.mp4",
    lines: [],
  },
  // Example (replace with your own):
  // {
  //   title: "Song name",
  //   artist: "Artist",
  //   youtubeId: "dQw4w9WgXcQ",
  //   videoUrl: "https://www.youtube.com/watch?v=dQw4w9WgXcQ",
  //   artistChannelUrl: "https://www.youtube.com/@ArtistChannel",
  //   lines: [
  //     { t: 12, text: "First lyric line" },
  //     { t: 17.5, text: "Second lyric line" },
  //   ],
  // },
];
