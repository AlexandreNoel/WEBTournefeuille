--
-- PostgreSQL database dump
--

-- Dumped from database version 11.0
-- Dumped by pg_dump version 11.0

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: annonce; Type: TABLE; Schema: public; Owner: ensiie
--

CREATE TABLE public.annonce (
    idannonce integer NOT NULL,
    titre character varying NOT NULL,
    contenu character varying NOT NULL,
    idauteur integer NOT NULL,
    datecreation date DEFAULT CURRENT_DATE NOT NULL
);


ALTER TABLE public.annonce OWNER TO ensiie;

--
-- Name: annonce_idannonce_seq; Type: SEQUENCE; Schema: public; Owner: ensiie
--

CREATE SEQUENCE public.annonce_idannonce_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.annonce_idannonce_seq OWNER TO ensiie;

--
-- Name: annonce_idannonce_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: ensiie
--

ALTER SEQUENCE public.annonce_idannonce_seq OWNED BY public.annonce.idannonce;


--
-- Name: barmen; Type: TABLE; Schema: public; Owner: ensiie
--

CREATE TABLE public.barmen (
    idutilisateur integer NOT NULL,
    codebarmen character varying NOT NULL
);


ALTER TABLE public.barmen OWNER TO ensiie;

--
-- Name: barmen_idutilisateur_seq; Type: SEQUENCE; Schema: public; Owner: ensiie
--

CREATE SEQUENCE public.barmen_idutilisateur_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.barmen_idutilisateur_seq OWNER TO ensiie;

--
-- Name: barmen_idutilisateur_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: ensiie
--

ALTER SEQUENCE public.barmen_idutilisateur_seq OWNED BY public.barmen.idutilisateur;


--
-- Name: categorie; Type: TABLE; Schema: public; Owner: ensiie
--

CREATE TABLE public.categorie (
    idcategorie integer NOT NULL,
    libelle character varying NOT NULL
);


ALTER TABLE public.categorie OWNER TO ensiie;

--
-- Name: categorie_idcategorie_seq; Type: SEQUENCE; Schema: public; Owner: ensiie
--

CREATE SEQUENCE public.categorie_idcategorie_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.categorie_idcategorie_seq OWNER TO ensiie;

--
-- Name: categorie_idcategorie_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: ensiie
--

ALTER SEQUENCE public.categorie_idcategorie_seq OWNED BY public.categorie.idcategorie;


--
-- Name: commande; Type: TABLE; Schema: public; Owner: ensiie
--

CREATE TABLE public.commande (
    idcommande integer NOT NULL,
    datecommande timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    idutilisateur integer NOT NULL,
    idbarmen integer NOT NULL,
    prixtotal numeric(19,2) NOT NULL
);


ALTER TABLE public.commande OWNER TO ensiie;

--
-- Name: commande_idcommande_seq; Type: SEQUENCE; Schema: public; Owner: ensiie
--

CREATE SEQUENCE public.commande_idcommande_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.commande_idcommande_seq OWNER TO ensiie;

--
-- Name: commande_idcommande_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: ensiie
--

ALTER SEQUENCE public.commande_idcommande_seq OWNED BY public.commande.idcommande;


--
-- Name: faitpartiecommande; Type: TABLE; Schema: public; Owner: ensiie
--

CREATE TABLE public.faitpartiecommande (
    idproduit integer NOT NULL,
    idcommande integer NOT NULL,
    prixvente numeric(19,2) NOT NULL,
    quantite integer NOT NULL
);


ALTER TABLE public.faitpartiecommande OWNER TO ensiie;

--
-- Name: faitpartiecommande_idcommande_seq; Type: SEQUENCE; Schema: public; Owner: ensiie
--

CREATE SEQUENCE public.faitpartiecommande_idcommande_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.faitpartiecommande_idcommande_seq OWNER TO ensiie;

--
-- Name: faitpartiecommande_idcommande_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: ensiie
--

ALTER SEQUENCE public.faitpartiecommande_idcommande_seq OWNED BY public.faitpartiecommande.idcommande;


--
-- Name: faitpartiecommande_idproduit_seq; Type: SEQUENCE; Schema: public; Owner: ensiie
--

CREATE SEQUENCE public.faitpartiecommande_idproduit_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.faitpartiecommande_idproduit_seq OWNER TO ensiie;

--
-- Name: faitpartiecommande_idproduit_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: ensiie
--

ALTER SEQUENCE public.faitpartiecommande_idproduit_seq OWNED BY public.faitpartiecommande.idproduit;


--
-- Name: nouveauproduit; Type: TABLE; Schema: public; Owner: ensiie
--

CREATE TABLE public.nouveauproduit (
    idnouveauproduit integer NOT NULL,
    libelle character varying NOT NULL,
    description character varying NOT NULL,
    idauteur integer NOT NULL
);


ALTER TABLE public.nouveauproduit OWNER TO ensiie;

--
-- Name: nouveauproduit_idnouveauproduit_seq; Type: SEQUENCE; Schema: public; Owner: ensiie
--

CREATE SEQUENCE public.nouveauproduit_idnouveauproduit_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.nouveauproduit_idnouveauproduit_seq OWNER TO ensiie;

--
-- Name: nouveauproduit_idnouveauproduit_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: ensiie
--

ALTER SEQUENCE public.nouveauproduit_idnouveauproduit_seq OWNED BY public.nouveauproduit.idnouveauproduit;


--
-- Name: produit; Type: TABLE; Schema: public; Owner: ensiie
--

CREATE TABLE public.produit (
    idproduit integer NOT NULL,
    libelle character varying NOT NULL,
    prix numeric(19,2) NOT NULL,
    reduction numeric(19,2) NOT NULL,
    quantitestock integer NOT NULL,
    estdisponible boolean NOT NULL,
    idcategorie integer NOT NULL
);


ALTER TABLE public.produit OWNER TO ensiie;

--
-- Name: produit_idproduit_seq; Type: SEQUENCE; Schema: public; Owner: ensiie
--

CREATE SEQUENCE public.produit_idproduit_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.produit_idproduit_seq OWNER TO ensiie;

--
-- Name: produit_idproduit_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: ensiie
--

ALTER SEQUENCE public.produit_idproduit_seq OWNED BY public.produit.idproduit;


--
-- Name: utilisateur; Type: TABLE; Schema: public; Owner: ensiie
--

CREATE TABLE public.utilisateur (
    idutilisateur integer NOT NULL,
    pseudo character varying NOT NULL,
    prenom character varying NOT NULL,
    nom character varying NOT NULL,
    solde numeric(19,2) NOT NULL
);


ALTER TABLE public.utilisateur OWNER TO ensiie;

--
-- Name: utilisateur_idutilisateur_seq; Type: SEQUENCE; Schema: public; Owner: ensiie
--

CREATE SEQUENCE public.utilisateur_idutilisateur_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.utilisateur_idutilisateur_seq OWNER TO ensiie;

--
-- Name: utilisateur_idutilisateur_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: ensiie
--

ALTER SEQUENCE public.utilisateur_idutilisateur_seq OWNED BY public.utilisateur.idutilisateur;


--
-- Name: vote; Type: TABLE; Schema: public; Owner: ensiie
--

CREATE TABLE public.vote (
    idutilisateur integer NOT NULL,
    idnouveauproduit integer NOT NULL,
    datevote timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE public.vote OWNER TO ensiie;

--
-- Name: vote_idnouveauproduit_seq; Type: SEQUENCE; Schema: public; Owner: ensiie
--

CREATE SEQUENCE public.vote_idnouveauproduit_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.vote_idnouveauproduit_seq OWNER TO ensiie;

--
-- Name: vote_idnouveauproduit_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: ensiie
--

ALTER SEQUENCE public.vote_idnouveauproduit_seq OWNED BY public.vote.idnouveauproduit;


--
-- Name: vote_idutilisateur_seq; Type: SEQUENCE; Schema: public; Owner: ensiie
--

CREATE SEQUENCE public.vote_idutilisateur_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.vote_idutilisateur_seq OWNER TO ensiie;

--
-- Name: vote_idutilisateur_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: ensiie
--

ALTER SEQUENCE public.vote_idutilisateur_seq OWNED BY public.vote.idutilisateur;


--
-- Name: annonce idannonce; Type: DEFAULT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.annonce ALTER COLUMN idannonce SET DEFAULT nextval('public.annonce_idannonce_seq'::regclass);


--
-- Name: barmen idutilisateur; Type: DEFAULT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.barmen ALTER COLUMN idutilisateur SET DEFAULT nextval('public.barmen_idutilisateur_seq'::regclass);


--
-- Name: categorie idcategorie; Type: DEFAULT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.categorie ALTER COLUMN idcategorie SET DEFAULT nextval('public.categorie_idcategorie_seq'::regclass);


--
-- Name: commande idcommande; Type: DEFAULT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.commande ALTER COLUMN idcommande SET DEFAULT nextval('public.commande_idcommande_seq'::regclass);


--
-- Name: faitpartiecommande idproduit; Type: DEFAULT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.faitpartiecommande ALTER COLUMN idproduit SET DEFAULT nextval('public.faitpartiecommande_idproduit_seq'::regclass);


--
-- Name: faitpartiecommande idcommande; Type: DEFAULT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.faitpartiecommande ALTER COLUMN idcommande SET DEFAULT nextval('public.faitpartiecommande_idcommande_seq'::regclass);


--
-- Name: nouveauproduit idnouveauproduit; Type: DEFAULT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.nouveauproduit ALTER COLUMN idnouveauproduit SET DEFAULT nextval('public.nouveauproduit_idnouveauproduit_seq'::regclass);


--
-- Name: produit idproduit; Type: DEFAULT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.produit ALTER COLUMN idproduit SET DEFAULT nextval('public.produit_idproduit_seq'::regclass);


--
-- Name: utilisateur idutilisateur; Type: DEFAULT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.utilisateur ALTER COLUMN idutilisateur SET DEFAULT nextval('public.utilisateur_idutilisateur_seq'::regclass);


--
-- Name: vote idutilisateur; Type: DEFAULT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.vote ALTER COLUMN idutilisateur SET DEFAULT nextval('public.vote_idutilisateur_seq'::regclass);


--
-- Name: vote idnouveauproduit; Type: DEFAULT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.vote ALTER COLUMN idnouveauproduit SET DEFAULT nextval('public.vote_idnouveauproduit_seq'::regclass);


--
-- Data for Name: annonce; Type: TABLE DATA; Schema: public; Owner: ensiie
--

COPY public.annonce (idannonce, titre, contenu, idauteur, datecreation) FROM stdin;
1	Nouvelle Application	<h1>Merci aux FIPAS </h1><br><p>Grace au travail acharnée des FIPAS, le BarC devient le BarD et vous porpose une toute nouvelle application de gestion de votre compte</p>	3	2018-01-01
2	Nouvelle Application	<h1>Merci aux FIPAS </h1><br><p>Grace au travail acharnée des FIPAS, le BarC devient le BarD et vous porpose une toute nouvelle application de gestion de votre compte</p>	3	2018-01-01
3	Nouvelle Application	<h1>Merci aux FIPAS </h1><br><p>Grace au travail acharnée des FIPAS, le BarC devient le BarD et vous porpose une toute nouvelle application de gestion de votre compte</p>	3	2018-01-01
\.


--
-- Data for Name: barmen; Type: TABLE DATA; Schema: public; Owner: ensiie
--

COPY public.barmen (idutilisateur, codebarmen) FROM stdin;
2	LaGuinessCestLaBase
\.


--
-- Data for Name: categorie; Type: TABLE DATA; Schema: public; Owner: ensiie
--

COPY public.categorie (idcategorie, libelle) FROM stdin;
1	Boisson
2	Friandise
3	Snack
4	Boissons Chaudes
\.


--
-- Data for Name: commande; Type: TABLE DATA; Schema: public; Owner: ensiie
--

COPY public.commande (idcommande, datecommande, idutilisateur, idbarmen, prixtotal) FROM stdin;
1	2018-09-19 00:00:00	3	2	1.00
2	2018-09-27 00:00:00	3	2	1.00
3	2018-06-11 00:00:00	3	2	1.00
4	2018-11-13 00:00:00	3	2	1.00
5	2018-02-16 00:00:00	3	2	1.00
6	2018-10-02 00:00:00	3	2	1.00
7	2018-04-06 00:00:00	3	2	1.00
8	2018-03-10 00:00:00	3	2	1.00
9	2018-11-16 00:00:00	3	2	1.00
10	2018-08-11 00:00:00	3	2	1.00
11	2018-05-15 00:00:00	3	2	1.00
12	2018-05-11 00:00:00	3	2	1.00
13	2018-05-24 00:00:00	3	2	1.00
14	2018-06-03 00:00:00	3	2	1.00
15	2018-01-02 00:00:00	3	2	1.00
16	2018-10-24 00:00:00	3	2	1.00
17	2018-01-15 00:00:00	3	2	1.00
18	2018-06-20 00:00:00	3	2	1.00
19	2018-02-19 00:00:00	3	2	1.00
20	2018-11-21 00:00:00	3	2	1.00
21	2018-08-11 00:00:00	3	2	1.00
22	2018-05-12 00:00:00	3	2	1.00
23	2018-12-02 00:00:00	3	2	1.00
24	2018-06-18 00:00:00	3	2	1.00
25	2018-09-09 00:00:00	3	2	1.00
26	2018-12-24 00:00:00	3	2	1.00
27	2018-03-09 00:00:00	3	2	1.00
28	2018-12-20 00:00:00	3	2	1.00
29	2018-04-07 00:00:00	3	2	1.00
30	2018-02-24 00:00:00	3	2	1.00
31	2018-11-07 00:00:00	3	2	1.00
32	2018-02-18 00:00:00	3	2	1.00
33	2018-01-08 00:00:00	3	2	1.00
34	2018-06-27 00:00:00	3	2	1.00
35	2018-02-17 00:00:00	3	2	1.00
36	2018-04-03 00:00:00	3	2	1.00
37	2018-05-09 00:00:00	3	2	1.00
38	2018-04-15 00:00:00	3	2	1.00
39	2018-05-21 00:00:00	3	2	1.00
40	2018-07-22 00:00:00	3	2	1.00
41	2018-03-20 00:00:00	3	2	1.00
42	2018-08-06 00:00:00	3	2	1.00
43	2018-10-23 00:00:00	3	2	1.00
44	2018-07-17 00:00:00	3	2	1.00
45	2018-04-01 00:00:00	3	2	1.00
46	2018-11-07 00:00:00	3	2	1.00
47	2018-09-05 00:00:00	3	2	1.00
48	2018-11-14 00:00:00	3	2	1.00
49	2018-11-28 00:00:00	3	2	1.00
50	2018-09-14 00:00:00	3	2	1.00
51	2018-09-01 00:00:00	3	2	1.00
52	2018-10-03 00:00:00	3	2	1.00
53	2018-01-07 00:00:00	3	2	1.00
54	2018-09-24 00:00:00	3	2	1.00
55	2018-12-03 00:00:00	3	2	1.00
56	2018-04-14 00:00:00	3	2	1.00
57	2018-11-28 00:00:00	3	2	1.00
58	2018-02-02 00:00:00	3	2	1.00
59	2018-03-15 00:00:00	3	2	1.00
60	2018-04-10 00:00:00	3	2	1.00
61	2018-04-22 00:00:00	3	2	1.00
62	2018-11-03 00:00:00	3	2	1.00
63	2018-03-19 00:00:00	3	2	1.00
64	2018-06-11 00:00:00	3	2	1.00
65	2018-01-09 00:00:00	3	2	1.00
66	2018-05-09 00:00:00	3	2	1.00
67	2018-06-23 00:00:00	3	2	1.00
68	2018-03-08 00:00:00	3	2	1.00
69	2018-08-19 00:00:00	3	2	1.00
70	2018-04-24 00:00:00	3	2	1.00
71	2018-08-01 00:00:00	3	2	1.00
72	2018-07-25 00:00:00	3	2	1.00
73	2018-09-19 00:00:00	3	2	1.00
74	2018-08-23 00:00:00	3	2	1.00
75	2018-03-05 00:00:00	3	2	1.00
76	2018-06-22 00:00:00	3	2	1.00
77	2018-06-17 00:00:00	3	2	1.00
78	2018-10-04 00:00:00	3	2	1.00
79	2018-11-04 00:00:00	3	2	1.00
80	2018-06-18 00:00:00	3	2	1.00
81	2018-11-19 00:00:00	3	2	1.00
82	2018-12-10 00:00:00	3	2	1.00
83	2018-07-12 00:00:00	3	2	1.00
84	2018-02-26 00:00:00	3	2	1.00
85	2018-06-08 00:00:00	3	2	1.00
86	2018-10-17 00:00:00	3	2	1.00
87	2018-12-26 00:00:00	3	2	1.00
88	2018-08-01 00:00:00	3	2	1.00
89	2018-12-16 00:00:00	3	2	1.00
90	2018-10-03 00:00:00	3	2	1.00
91	2018-06-25 00:00:00	3	2	1.00
92	2018-01-17 00:00:00	3	2	1.00
93	2018-01-13 00:00:00	3	2	1.00
94	2018-05-05 00:00:00	3	2	1.00
95	2018-06-08 00:00:00	3	2	1.00
96	2018-01-13 00:00:00	3	2	1.00
97	2018-06-10 00:00:00	3	2	1.00
98	2018-09-09 00:00:00	3	2	1.00
99	2018-12-03 00:00:00	3	2	1.00
100	2018-05-18 00:00:00	3	2	1.00
101	2018-06-18 00:00:00	3	2	1.00
102	2018-05-21 00:00:00	3	2	1.00
103	2018-01-09 00:00:00	3	2	1.00
104	2018-12-20 00:00:00	3	2	1.00
105	2018-06-10 00:00:00	3	2	1.00
106	2018-11-13 00:00:00	3	2	1.00
107	2018-10-17 00:00:00	3	2	1.00
108	2018-09-10 00:00:00	3	2	1.00
109	2018-10-20 00:00:00	3	2	1.00
110	2018-02-19 00:00:00	3	2	1.00
111	2018-05-07 00:00:00	3	2	1.00
112	2018-07-24 00:00:00	3	2	1.00
113	2018-09-05 00:00:00	3	2	1.00
114	2018-01-13 00:00:00	3	2	1.00
115	2018-05-09 00:00:00	3	2	1.00
116	2018-06-02 00:00:00	3	2	1.00
117	2018-11-16 00:00:00	3	2	1.00
118	2018-11-28 00:00:00	3	2	1.00
119	2018-03-04 00:00:00	3	2	1.00
120	2018-02-10 00:00:00	3	2	1.00
121	2018-07-04 00:00:00	3	2	1.00
122	2018-09-17 00:00:00	3	2	1.00
123	2018-03-06 00:00:00	3	2	1.00
124	2018-04-26 00:00:00	3	2	1.00
125	2018-03-04 00:00:00	3	2	1.00
126	2018-05-04 00:00:00	3	2	1.00
127	2018-03-04 00:00:00	3	2	1.00
128	2018-11-05 00:00:00	3	2	1.00
129	2018-09-20 00:00:00	3	2	1.00
130	2018-10-14 00:00:00	3	2	1.00
131	2018-02-14 00:00:00	3	2	1.00
132	2018-04-20 00:00:00	3	2	1.00
133	2018-03-14 00:00:00	3	2	1.00
134	2018-07-04 00:00:00	3	2	1.00
135	2018-09-25 00:00:00	3	2	1.00
136	2018-07-11 00:00:00	3	2	1.00
137	2018-09-14 00:00:00	3	2	1.00
138	2018-09-28 00:00:00	3	2	1.00
139	2018-10-03 00:00:00	3	2	1.00
140	2018-10-19 00:00:00	3	2	1.00
141	2018-06-05 00:00:00	3	2	1.00
142	2018-08-17 00:00:00	3	2	1.00
143	2018-03-09 00:00:00	3	2	1.00
144	2018-08-14 00:00:00	3	2	1.00
145	2018-09-16 00:00:00	3	2	1.00
146	2018-03-19 00:00:00	3	2	1.00
147	2018-04-10 00:00:00	3	2	1.00
148	2018-02-18 00:00:00	3	2	1.00
149	2018-06-14 00:00:00	3	2	1.00
150	2018-10-14 00:00:00	3	2	1.00
151	2018-09-16 00:00:00	3	2	1.00
152	2018-09-17 00:00:00	3	2	1.00
153	2018-12-06 00:00:00	3	2	1.00
154	2018-02-11 00:00:00	3	2	1.00
155	2018-12-28 00:00:00	3	2	1.00
156	2018-07-16 00:00:00	3	2	1.00
157	2018-11-14 00:00:00	3	2	1.00
158	2018-12-14 00:00:00	3	2	1.00
159	2018-03-20 00:00:00	3	2	1.00
160	2018-11-23 00:00:00	3	2	1.00
161	2018-03-16 00:00:00	3	2	1.00
162	2018-02-19 00:00:00	3	2	1.00
163	2018-01-28 00:00:00	3	2	1.00
164	2018-02-23 00:00:00	3	2	1.00
165	2018-08-05 00:00:00	3	2	1.00
166	2018-05-15 00:00:00	3	2	1.00
167	2018-02-17 00:00:00	3	2	1.00
168	2018-12-15 00:00:00	3	2	1.00
169	2018-03-12 00:00:00	3	2	1.00
170	2018-01-15 00:00:00	3	2	1.00
171	2018-07-08 00:00:00	3	2	1.00
172	2018-10-23 00:00:00	3	2	1.00
173	2018-12-17 00:00:00	3	2	1.00
174	2018-04-06 00:00:00	3	2	1.00
175	2018-08-28 00:00:00	3	2	1.00
176	2018-09-06 00:00:00	3	2	1.00
177	2018-02-16 00:00:00	3	2	1.00
178	2018-06-20 00:00:00	3	2	1.00
179	2018-04-04 00:00:00	3	2	1.00
180	2018-09-26 00:00:00	3	2	1.00
181	2018-06-13 00:00:00	3	2	1.00
182	2018-06-18 00:00:00	3	2	1.00
183	2018-02-22 00:00:00	3	2	1.00
184	2018-09-23 00:00:00	3	2	1.00
185	2018-08-26 00:00:00	3	2	1.00
186	2018-03-11 00:00:00	3	2	1.00
187	2018-12-02 00:00:00	3	2	1.00
188	2018-03-12 00:00:00	3	2	1.00
189	2018-04-01 00:00:00	3	2	1.00
190	2018-08-08 00:00:00	3	2	1.00
191	2018-07-24 00:00:00	3	2	1.00
192	2018-10-16 00:00:00	3	2	1.00
193	2018-10-17 00:00:00	3	2	1.00
194	2018-12-27 00:00:00	3	2	1.00
195	2018-05-23 00:00:00	3	2	1.00
196	2018-11-28 00:00:00	3	2	1.00
197	2018-05-21 00:00:00	3	2	1.00
198	2018-12-09 00:00:00	3	2	1.00
199	2018-06-05 00:00:00	3	2	1.00
200	2018-02-11 00:00:00	3	2	1.00
201	2018-06-04 00:00:00	3	2	1.00
202	2018-08-28 00:00:00	3	2	1.00
203	2018-01-16 00:00:00	3	2	1.00
204	2018-01-18 00:00:00	3	2	1.00
205	2018-05-25 00:00:00	3	2	1.00
206	2018-01-04 00:00:00	3	2	1.00
207	2018-09-21 00:00:00	3	2	1.00
208	2018-10-19 00:00:00	3	2	1.00
209	2018-06-15 00:00:00	3	2	1.00
210	2018-03-09 00:00:00	3	2	1.00
211	2018-11-19 00:00:00	3	2	1.00
212	2018-10-13 00:00:00	3	2	1.00
213	2018-05-15 00:00:00	3	2	1.00
214	2018-01-14 00:00:00	3	2	1.00
215	2018-05-18 00:00:00	3	2	1.00
216	2018-10-21 00:00:00	3	2	1.00
217	2018-05-10 00:00:00	3	2	1.00
218	2018-12-23 00:00:00	3	2	1.00
219	2018-06-04 00:00:00	3	2	1.00
220	2018-10-14 00:00:00	3	2	1.00
221	2018-05-03 00:00:00	3	2	1.00
222	2018-04-16 00:00:00	3	2	1.00
223	2018-01-12 00:00:00	3	2	1.00
224	2018-03-10 00:00:00	3	2	1.00
225	2018-05-09 00:00:00	3	2	1.00
226	2018-02-23 00:00:00	3	2	1.00
227	2018-05-09 00:00:00	3	2	1.00
228	2018-10-26 00:00:00	3	2	1.00
229	2018-12-21 00:00:00	3	2	1.00
230	2018-05-28 00:00:00	3	2	1.00
231	2018-12-11 00:00:00	3	2	1.00
232	2018-11-21 00:00:00	3	2	1.00
233	2018-07-27 00:00:00	3	2	1.00
234	2018-08-03 00:00:00	3	2	1.00
235	2018-06-04 00:00:00	3	2	1.00
236	2018-04-25 00:00:00	3	2	1.00
237	2018-02-07 00:00:00	3	2	1.00
238	2018-10-23 00:00:00	3	2	1.00
239	2018-09-17 00:00:00	3	2	1.00
240	2018-08-11 00:00:00	3	2	1.00
241	2018-12-10 00:00:00	3	2	1.00
242	2018-10-02 00:00:00	3	2	1.00
243	2018-11-24 00:00:00	3	2	1.00
244	2018-06-05 00:00:00	3	2	1.00
245	2018-02-09 00:00:00	3	2	1.00
246	2018-03-15 00:00:00	3	2	1.00
247	2018-09-02 00:00:00	3	2	1.00
248	2018-11-09 00:00:00	3	2	1.00
249	2018-12-18 00:00:00	3	2	1.00
\.


--
-- Data for Name: faitpartiecommande; Type: TABLE DATA; Schema: public; Owner: ensiie
--

COPY public.faitpartiecommande (idproduit, idcommande, prixvente, quantite) FROM stdin;
3	1	0.50	2
1	2	0.50	2
4	2	3.00	1
2	2	0.50	1
3	3	0.50	1
2	3	0.50	3
1	3	0.50	2
2	4	0.50	3
1	4	0.50	2
5	4	4.00	2
1	5	0.50	3
4	5	3.00	1
4	6	3.00	1
5	7	4.00	3
2	8	0.50	3
5	8	4.00	1
4	9	3.00	2
5	9	4.00	2
3	9	0.50	2
3	10	0.50	2
4	10	3.00	2
5	11	4.00	3
4	12	3.00	1
4	13	3.00	2
5	13	4.00	1
1	14	0.50	2
3	14	0.50	3
5	15	4.00	1
2	16	0.50	2
5	16	4.00	1
4	17	3.00	3
2	17	0.50	1
5	18	4.00	2
3	19	0.50	3
1	20	0.50	3
2	20	0.50	1
3	20	0.50	3
3	21	0.50	2
2	22	0.50	3
1	22	0.50	1
5	22	4.00	1
4	23	3.00	2
1	24	0.50	3
4	25	3.00	1
5	26	4.00	1
2	26	0.50	3
1	27	0.50	3
3	28	0.50	3
1	28	0.50	3
4	29	3.00	2
5	30	4.00	3
2	30	0.50	2
4	31	3.00	2
3	32	0.50	2
4	32	3.00	1
1	33	0.50	2
2	33	0.50	1
3	34	0.50	3
4	34	3.00	2
2	35	0.50	1
1	35	0.50	1
3	35	0.50	1
1	36	0.50	1
4	37	3.00	2
3	37	0.50	2
5	38	4.00	2
1	39	0.50	3
5	39	4.00	1
4	40	3.00	2
1	40	0.50	3
5	41	4.00	1
3	41	0.50	3
4	42	3.00	1
2	42	0.50	3
5	43	4.00	1
4	44	3.00	1
3	44	0.50	2
2	44	0.50	2
1	45	0.50	2
4	46	3.00	3
3	47	0.50	1
4	48	3.00	1
2	48	0.50	1
4	49	3.00	2
5	49	4.00	1
1	50	0.50	2
4	51	3.00	1
2	52	0.50	1
5	52	4.00	3
3	52	0.50	2
2	53	0.50	1
5	54	4.00	1
2	54	0.50	1
1	54	0.50	2
4	55	3.00	2
1	55	0.50	3
3	56	0.50	1
1	57	0.50	1
5	58	4.00	2
2	59	0.50	2
5	59	4.00	1
3	59	0.50	3
3	60	0.50	3
4	60	3.00	2
5	60	4.00	2
4	61	3.00	3
3	62	0.50	1
4	62	3.00	1
2	62	0.50	2
5	63	4.00	2
1	64	0.50	2
4	64	3.00	1
3	64	0.50	3
2	65	0.50	2
1	65	0.50	3
4	66	3.00	2
5	67	4.00	3
2	67	0.50	3
3	67	0.50	1
2	68	0.50	1
2	69	0.50	2
5	69	4.00	3
2	70	0.50	3
3	71	0.50	2
2	71	0.50	3
1	72	0.50	3
3	72	0.50	1
2	73	0.50	3
4	74	3.00	2
1	74	0.50	3
1	75	0.50	2
1	76	0.50	2
4	76	3.00	2
5	77	4.00	1
3	77	0.50	2
4	78	3.00	3
1	78	0.50	3
2	78	0.50	2
3	79	0.50	3
1	79	0.50	3
2	79	0.50	2
3	80	0.50	3
5	80	4.00	2
4	80	3.00	1
4	81	3.00	3
5	81	4.00	1
3	82	0.50	2
4	82	3.00	1
1	83	0.50	1
1	84	0.50	2
4	84	3.00	2
5	84	4.00	1
2	85	0.50	1
4	85	3.00	2
4	86	3.00	3
3	87	0.50	3
5	88	4.00	2
4	89	3.00	3
2	90	0.50	2
4	90	3.00	2
3	90	0.50	3
1	91	0.50	2
2	91	0.50	3
3	91	0.50	2
3	92	0.50	3
4	92	3.00	2
2	92	0.50	2
3	93	0.50	2
4	93	3.00	2
3	94	0.50	2
4	94	3.00	3
5	94	4.00	1
2	95	0.50	2
4	96	3.00	2
5	97	4.00	3
3	97	0.50	2
4	97	3.00	3
5	98	4.00	3
1	99	0.50	1
2	100	0.50	3
4	100	3.00	3
5	101	4.00	2
2	101	0.50	2
3	102	0.50	3
4	103	3.00	3
2	103	0.50	3
1	103	0.50	2
1	104	0.50	1
3	104	0.50	2
5	104	4.00	1
3	105	0.50	1
2	105	0.50	3
2	106	0.50	2
4	107	3.00	1
1	107	0.50	3
5	107	4.00	2
1	108	0.50	3
3	108	0.50	2
4	108	3.00	1
5	109	4.00	1
3	109	0.50	2
4	109	3.00	2
2	110	0.50	3
1	110	0.50	3
1	111	0.50	1
2	112	0.50	3
5	112	4.00	3
3	113	0.50	1
5	113	4.00	2
1	113	0.50	2
2	114	0.50	3
4	114	3.00	3
5	114	4.00	3
3	115	0.50	3
5	115	4.00	3
2	115	0.50	3
1	116	0.50	1
5	117	4.00	1
1	117	0.50	3
1	118	0.50	3
3	118	0.50	2
1	119	0.50	2
3	119	0.50	3
4	119	3.00	1
2	120	0.50	1
4	120	3.00	1
2	121	0.50	3
3	122	0.50	3
2	122	0.50	1
4	123	3.00	1
3	123	0.50	2
2	124	0.50	3
5	125	4.00	3
4	125	3.00	3
4	126	3.00	2
2	126	0.50	2
1	127	0.50	1
5	128	4.00	2
3	128	0.50	1
1	129	0.50	1
4	129	3.00	1
5	130	4.00	2
2	130	0.50	3
3	131	0.50	2
1	132	0.50	2
5	132	4.00	3
4	132	3.00	2
4	133	3.00	1
1	133	0.50	3
2	134	0.50	3
1	134	0.50	2
3	134	0.50	1
5	135	4.00	2
3	135	0.50	1
4	136	3.00	2
1	136	0.50	3
3	136	0.50	3
4	137	3.00	1
5	137	4.00	3
5	138	4.00	3
1	139	0.50	1
3	140	0.50	3
2	140	0.50	3
3	141	0.50	3
1	141	0.50	3
4	141	3.00	2
2	142	0.50	1
4	143	3.00	3
2	143	0.50	3
3	143	0.50	1
1	144	0.50	2
5	144	4.00	1
4	144	3.00	1
1	145	0.50	1
5	145	4.00	1
4	146	3.00	2
3	146	0.50	2
3	147	0.50	2
3	148	0.50	2
2	148	0.50	3
5	148	4.00	1
1	149	0.50	2
5	149	4.00	1
1	150	0.50	1
2	150	0.50	1
5	151	4.00	3
2	151	0.50	1
2	152	0.50	2
1	153	0.50	3
3	153	0.50	3
5	153	4.00	1
1	154	0.50	1
5	155	4.00	3
3	155	0.50	1
3	156	0.50	3
4	156	3.00	1
2	156	0.50	3
4	157	3.00	2
1	157	0.50	1
3	158	0.50	3
2	158	0.50	2
4	158	3.00	1
2	159	0.50	3
4	159	3.00	2
1	159	0.50	3
2	160	0.50	3
3	161	0.50	2
1	161	0.50	3
1	162	0.50	3
3	162	0.50	3
4	163	3.00	2
4	164	3.00	1
1	164	0.50	3
4	165	3.00	1
5	166	4.00	1
4	167	3.00	1
3	167	0.50	2
2	167	0.50	2
1	168	0.50	3
3	168	0.50	2
2	168	0.50	2
3	169	0.50	2
1	169	0.50	2
5	169	4.00	3
4	170	3.00	2
5	171	4.00	3
2	171	0.50	3
3	172	0.50	1
5	172	4.00	2
2	172	0.50	3
5	173	4.00	1
4	173	3.00	2
3	173	0.50	1
1	174	0.50	2
3	175	0.50	2
4	175	3.00	3
5	175	4.00	2
1	176	0.50	2
3	176	0.50	1
4	176	3.00	1
3	177	0.50	1
1	178	0.50	3
4	178	3.00	1
3	179	0.50	1
1	179	0.50	2
3	180	0.50	3
4	180	3.00	1
5	180	4.00	2
5	181	4.00	3
3	181	0.50	3
4	181	3.00	1
2	182	0.50	1
1	182	0.50	3
5	183	4.00	3
1	183	0.50	1
4	183	3.00	2
1	184	0.50	2
4	184	3.00	3
5	184	4.00	2
2	185	0.50	3
4	185	3.00	1
3	185	0.50	2
5	186	4.00	2
1	186	0.50	3
3	187	0.50	1
2	187	0.50	2
1	187	0.50	1
2	188	0.50	3
3	188	0.50	1
4	189	3.00	1
3	189	0.50	1
4	190	3.00	2
3	190	0.50	2
3	191	0.50	1
3	192	0.50	3
2	192	0.50	3
1	192	0.50	3
3	193	0.50	3
2	193	0.50	2
4	193	3.00	1
5	194	4.00	2
1	194	0.50	1
3	194	0.50	1
4	195	3.00	2
1	195	0.50	3
3	196	0.50	2
4	196	3.00	2
1	196	0.50	2
3	197	0.50	1
3	198	0.50	1
1	198	0.50	3
2	198	0.50	3
3	199	0.50	1
4	200	3.00	1
5	200	4.00	2
2	201	0.50	2
3	201	0.50	2
4	202	3.00	1
2	202	0.50	3
2	203	0.50	3
4	204	3.00	1
2	204	0.50	1
5	204	4.00	1
2	205	0.50	1
4	205	3.00	3
3	206	0.50	3
5	206	4.00	3
2	206	0.50	1
3	207	0.50	3
2	207	0.50	3
4	207	3.00	3
4	208	3.00	2
3	208	0.50	1
5	208	4.00	1
5	209	4.00	1
3	209	0.50	2
4	209	3.00	2
1	210	0.50	1
2	210	0.50	2
4	210	3.00	1
3	211	0.50	3
2	211	0.50	1
5	212	4.00	3
2	212	0.50	1
1	212	0.50	2
4	213	3.00	3
2	213	0.50	1
4	214	3.00	3
3	214	0.50	2
5	214	4.00	3
2	215	0.50	3
4	216	3.00	3
4	217	3.00	3
5	218	4.00	2
5	219	4.00	1
1	219	0.50	1
4	220	3.00	3
2	220	0.50	1
5	220	4.00	3
5	221	4.00	3
2	221	0.50	3
3	221	0.50	1
5	222	4.00	2
2	222	0.50	1
1	222	0.50	2
1	223	0.50	2
2	224	0.50	2
2	225	0.50	3
5	226	4.00	1
2	226	0.50	2
3	226	0.50	2
1	227	0.50	2
1	228	0.50	3
2	228	0.50	3
1	229	0.50	3
3	229	0.50	1
5	229	4.00	3
5	230	4.00	3
2	230	0.50	1
1	230	0.50	3
3	231	0.50	2
2	231	0.50	3
1	232	0.50	1
5	233	4.00	2
1	233	0.50	3
4	234	3.00	3
3	234	0.50	1
1	234	0.50	3
5	235	4.00	2
4	236	3.00	2
2	236	0.50	3
3	236	0.50	2
2	237	0.50	2
4	238	3.00	1
3	238	0.50	2
2	238	0.50	3
1	239	0.50	1
5	240	4.00	1
2	240	0.50	2
4	240	3.00	2
4	241	3.00	2
2	241	0.50	1
3	241	0.50	3
3	242	0.50	3
4	243	3.00	1
1	244	0.50	3
5	244	4.00	1
2	244	0.50	2
3	245	0.50	2
2	246	0.50	1
4	246	3.00	3
1	246	0.50	1
5	247	4.00	3
3	247	0.50	3
3	248	0.50	2
2	248	0.50	2
3	249	0.50	2
1	249	0.50	2
5	249	4.00	3
\.


--
-- Data for Name: nouveauproduit; Type: TABLE DATA; Schema: public; Owner: ensiie
--

COPY public.nouveauproduit (idnouveauproduit, libelle, description, idauteur) FROM stdin;
1	RedBull	Pour avoir des ailes en allant en cours	1
\.


--
-- Data for Name: produit; Type: TABLE DATA; Schema: public; Owner: ensiie
--

COPY public.produit (idproduit, libelle, prix, reduction, quantitestock, estdisponible, idcategorie) FROM stdin;
1	Coca	0.50	0.00	4	t	1
2	Fanta	0.50	0.00	2	t	1
3	Sprite	0.50	0.00	5	t	1
4	Pizza ChouFleur	1.60	0.00	2	t	3
5	Buns Flageolet	1.50	0.00	2	t	3
6	Mars	0.50	0.00	2	t	2
7	Kinder Bueno	0.50	0.00	2	t	2
8	Cafe Fort	0.40	0.00	20	t	4
9	Cafe leger	0.40	0.00	20	t	4
10	Thé	0.40	0.00	20	t	4
\.


--
-- Data for Name: utilisateur; Type: TABLE DATA; Schema: public; Owner: ensiie
--

COPY public.utilisateur (idutilisateur, pseudo, prenom, nom, solde) FROM stdin;
1	GEFCLIC	Benoit	SCHOLL	25.00
2	CHAP	Antoine	CHAPUSOT	25.00
3	TOAST	Théo	PEUCKERT	25.00
4	lineal	rémy	mollandin	0.00
\.


--
-- Data for Name: vote; Type: TABLE DATA; Schema: public; Owner: ensiie
--

COPY public.vote (idutilisateur, idnouveauproduit, datevote) FROM stdin;
\.


--
-- Name: annonce_idannonce_seq; Type: SEQUENCE SET; Schema: public; Owner: ensiie
--

SELECT pg_catalog.setval('public.annonce_idannonce_seq', 3, true);


--
-- Name: barmen_idutilisateur_seq; Type: SEQUENCE SET; Schema: public; Owner: ensiie
--

SELECT pg_catalog.setval('public.barmen_idutilisateur_seq', 1, false);


--
-- Name: categorie_idcategorie_seq; Type: SEQUENCE SET; Schema: public; Owner: ensiie
--

SELECT pg_catalog.setval('public.categorie_idcategorie_seq', 1, false);


--
-- Name: commande_idcommande_seq; Type: SEQUENCE SET; Schema: public; Owner: ensiie
--

SELECT pg_catalog.setval('public.commande_idcommande_seq', 249, true);


--
-- Name: faitpartiecommande_idcommande_seq; Type: SEQUENCE SET; Schema: public; Owner: ensiie
--

SELECT pg_catalog.setval('public.faitpartiecommande_idcommande_seq', 1, false);


--
-- Name: faitpartiecommande_idproduit_seq; Type: SEQUENCE SET; Schema: public; Owner: ensiie
--

SELECT pg_catalog.setval('public.faitpartiecommande_idproduit_seq', 1, false);


--
-- Name: nouveauproduit_idnouveauproduit_seq; Type: SEQUENCE SET; Schema: public; Owner: ensiie
--

SELECT pg_catalog.setval('public.nouveauproduit_idnouveauproduit_seq', 1, false);


--
-- Name: produit_idproduit_seq; Type: SEQUENCE SET; Schema: public; Owner: ensiie
--

SELECT pg_catalog.setval('public.produit_idproduit_seq', 10, true);


--
-- Name: utilisateur_idutilisateur_seq; Type: SEQUENCE SET; Schema: public; Owner: ensiie
--

SELECT pg_catalog.setval('public.utilisateur_idutilisateur_seq', 4, true);


--
-- Name: vote_idnouveauproduit_seq; Type: SEQUENCE SET; Schema: public; Owner: ensiie
--

SELECT pg_catalog.setval('public.vote_idnouveauproduit_seq', 1, false);


--
-- Name: vote_idutilisateur_seq; Type: SEQUENCE SET; Schema: public; Owner: ensiie
--

SELECT pg_catalog.setval('public.vote_idutilisateur_seq', 1, false);


--
-- Name: annonce annonce_pkey; Type: CONSTRAINT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.annonce
    ADD CONSTRAINT annonce_pkey PRIMARY KEY (idannonce);


--
-- Name: barmen barmen_codebarmen_key; Type: CONSTRAINT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.barmen
    ADD CONSTRAINT barmen_codebarmen_key UNIQUE (codebarmen);


--
-- Name: barmen barmen_pkey; Type: CONSTRAINT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.barmen
    ADD CONSTRAINT barmen_pkey PRIMARY KEY (idutilisateur);


--
-- Name: categorie categorie_pkey; Type: CONSTRAINT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.categorie
    ADD CONSTRAINT categorie_pkey PRIMARY KEY (idcategorie);


--
-- Name: commande commande_pkey; Type: CONSTRAINT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.commande
    ADD CONSTRAINT commande_pkey PRIMARY KEY (idcommande);


--
-- Name: faitpartiecommande faitpartiecommande_pkey; Type: CONSTRAINT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.faitpartiecommande
    ADD CONSTRAINT faitpartiecommande_pkey PRIMARY KEY (idproduit, idcommande);


--
-- Name: nouveauproduit nouveauproduit_pkey; Type: CONSTRAINT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.nouveauproduit
    ADD CONSTRAINT nouveauproduit_pkey PRIMARY KEY (idnouveauproduit);


--
-- Name: produit produit_pkey; Type: CONSTRAINT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.produit
    ADD CONSTRAINT produit_pkey PRIMARY KEY (idproduit);


--
-- Name: utilisateur utilisateur_pkey; Type: CONSTRAINT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.utilisateur
    ADD CONSTRAINT utilisateur_pkey PRIMARY KEY (idutilisateur);


--
-- Name: utilisateur utilisateur_pseudo_key; Type: CONSTRAINT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.utilisateur
    ADD CONSTRAINT utilisateur_pseudo_key UNIQUE (pseudo);


--
-- Name: vote vote_pkey; Type: CONSTRAINT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.vote
    ADD CONSTRAINT vote_pkey PRIMARY KEY (idutilisateur, idnouveauproduit);


--
-- Name: annonce annonce_idauteur_fkey; Type: FK CONSTRAINT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.annonce
    ADD CONSTRAINT annonce_idauteur_fkey FOREIGN KEY (idauteur) REFERENCES public.utilisateur(idutilisateur);


--
-- Name: barmen barmen_idutilisateur_fkey; Type: FK CONSTRAINT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.barmen
    ADD CONSTRAINT barmen_idutilisateur_fkey FOREIGN KEY (idutilisateur) REFERENCES public.utilisateur(idutilisateur) ON DELETE CASCADE;


--
-- Name: commande commande_idbarmen_fkey; Type: FK CONSTRAINT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.commande
    ADD CONSTRAINT commande_idbarmen_fkey FOREIGN KEY (idbarmen) REFERENCES public.utilisateur(idutilisateur);


--
-- Name: commande commande_idutilisateur_fkey; Type: FK CONSTRAINT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.commande
    ADD CONSTRAINT commande_idutilisateur_fkey FOREIGN KEY (idutilisateur) REFERENCES public.utilisateur(idutilisateur);


--
-- Name: faitpartiecommande faitpartiecommande_idcommande_fkey; Type: FK CONSTRAINT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.faitpartiecommande
    ADD CONSTRAINT faitpartiecommande_idcommande_fkey FOREIGN KEY (idcommande) REFERENCES public.commande(idcommande);


--
-- Name: faitpartiecommande faitpartiecommande_idproduit_fkey; Type: FK CONSTRAINT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.faitpartiecommande
    ADD CONSTRAINT faitpartiecommande_idproduit_fkey FOREIGN KEY (idproduit) REFERENCES public.produit(idproduit);


--
-- Name: nouveauproduit nouveauproduit_idauteur_fkey; Type: FK CONSTRAINT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.nouveauproduit
    ADD CONSTRAINT nouveauproduit_idauteur_fkey FOREIGN KEY (idauteur) REFERENCES public.utilisateur(idutilisateur);


--
-- Name: produit produit_idcategorie_fkey; Type: FK CONSTRAINT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.produit
    ADD CONSTRAINT produit_idcategorie_fkey FOREIGN KEY (idcategorie) REFERENCES public.categorie(idcategorie);


--
-- Name: vote vote_idnouveauproduit_fkey; Type: FK CONSTRAINT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.vote
    ADD CONSTRAINT vote_idnouveauproduit_fkey FOREIGN KEY (idnouveauproduit) REFERENCES public.nouveauproduit(idnouveauproduit);


--
-- Name: vote vote_idutilisateur_fkey; Type: FK CONSTRAINT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.vote
    ADD CONSTRAINT vote_idutilisateur_fkey FOREIGN KEY (idutilisateur) REFERENCES public.utilisateur(idutilisateur);


--
-- PostgreSQL database dump complete
--

