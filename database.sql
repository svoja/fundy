CREATE DATABASE IF NOT EXISTS user_management;

USE user_management;

CREATE TABLE IF NOT EXISTS teams (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE,
    location VARCHAR(100) NOT NULL,
    logo VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS players (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    team VARCHAR(100) NOT NULL,
    position VARCHAR(50) NOT NULL,
    photo VARCHAR(255) NOT NULL
);

INSERT INTO teams (name, location, logo) VALUES
('Atlanta Hawks', 'Atlanta', 'images/teams/atlanta_hawks.png'),
('Boston Celtics', 'Boston', 'images/teams/boston_celtics.png'),
('Brooklyn Nets', 'Brooklyn', 'images/teams/brooklyn_nets.png'),
('Charlotte Hornets', 'Charlotte', 'images/teams/charlotte_hornets.png'),
('Chicago Bulls', 'Chicago', 'images/teams/chicago_bulls.png'),
('Cleveland Cavaliers', 'Cleveland', 'images/teams/cleveland_cavaliers.png'),
('Dallas Mavericks', 'Dallas', 'images/teams/dallas_mavericks.png'),
('Denver Nuggets', 'Denver', 'images/teams/denver_nuggets.png'),
('Detroit Pistons', 'Detroit', 'images/teams/detroit_pistons.png'),
('Golden State Warriors', 'San Francisco', 'images/teams/golden_state_warriors.png'),
('Houston Rockets', 'Houston', 'images/teams/houston_rockets.png'),
('Indiana Pacers', 'Indiana', 'images/teams/indiana_pacers.png'),
('Los Angeles Clippers', 'Los Angeles', 'images/teams/los_angeles_clippers.png'),
('Los Angeles Lakers', 'Los Angeles', 'images/teams/los_angeles_lakers.png'),
('Memphis Grizzlies', 'Memphis', 'images/teams/memphis_grizzlies.png'),
('Miami Heat', 'Miami', 'images/teams/miami_heat.png'),
('Milwaukee Bucks', 'Milwaukee', 'images/teams/milwaukee_bucks.png'),
('Minnesota Timberwolves', 'Minnesota', 'images/teams/minnesota_timberwolves.png'),
('New Orleans Pelicans', 'New Orleans', 'images/teams/new_orleans_pelicans.png'),
('New York Knicks', 'New York', 'images/teams/new_york_knicks.png'),
('Oklahoma City Thunder', 'Oklahoma City', 'images/teams/oklahoma_city_thunder.png'),
('Orlando Magic', 'Orlando', 'images/teams/orlando_magic.png'),
('Philadelphia 76ers', 'Philadelphia', 'images/teams/philadelphia_76ers.png'),
('Phoenix Suns', 'Phoenix', 'images/teams/phoenix_suns.png'),
('Portland Trail Blazers', 'Portland', 'images/teams/portland_trail_blazers.png'),
('Sacramento Kings', 'Sacramento', 'images/teams/sacramento_kings.png'),
('San Antonio Spurs', 'San Antonio', 'images/teams/san_antonio_spurs.png'),
('Toronto Raptors', 'Toronto', 'images/teams/toronto_raptors.png'),
('Utah Jazz', 'Utah', 'images/teams/utah_jazz.png'),
('Washington Wizards', 'Washington', 'images/teams/washington_wizards.png');

INSERT INTO players (name, team, position, photo) VALUES
('Trae Young', 'Atlanta Hawks', 'Guard', 'images/players/trae_young.png'),
('Jayson Tatum', 'Boston Celtics', 'Forward', 'images/players/jayson_tatum.png'),
('Kevin Durant', 'Brooklyn Nets', 'Forward', 'images/players/kevin_durant.png'),
('LaMelo Ball', 'Charlotte Hornets', 'Guard', 'images/players/lamelo_ball.png'),
('Zach LaVine', 'Chicago Bulls', 'Guard', 'images/players/zach_lavine.png'),
('Donovan Mitchell', 'Cleveland Cavaliers', 'Guard', 'images/players/donovan_mitchell.png'),
('Luka Doncic', 'Dallas Mavericks', 'Guard', 'images/players/luka_doncic.png'),
('Nikola Jokic', 'Denver Nuggets', 'Center', 'images/players/nikola_jokic.png'),
('Cade Cunningham', 'Detroit Pistons', 'Guard', 'images/players/cade_cunningham.png'),
('Stephen Curry', 'Golden State Warriors', 'Guard', 'images/players/stephen_curry.png'),
('Jalen Green', 'Houston Rockets', 'Guard', 'images/players/jalen_green.png'),
('Tyrese Haliburton', 'Indiana Pacers', 'Guard', 'images/players/tyrese_haliburton.png'),
('Kawhi Leonard', 'Los Angeles Clippers', 'Forward', 'images/players/kawhi_leonard.png'),
('LeBron James', 'Los Angeles Lakers', 'Forward', 'images/players/lebron_james.png'),
('Ja Morant', 'Memphis Grizzlies', 'Guard', 'images/players/ja_morant.png'),
('Jimmy Butler', 'Miami Heat', 'Forward', 'images/players/jimmy_butler.png'),
('Giannis Antetokounmpo', 'Milwaukee Bucks', 'Forward', 'images/players/giannis_antetokounmpo.png'),
('Karl-Anthony Towns', 'Minnesota Timberwolves', 'Center', 'images/players/karl_anthony_towns.png'),
('Zion Williamson', 'New Orleans Pelicans', 'Forward', 'images/players/zion_williamson.png'),
('Julius Randle', 'New York Knicks', 'Forward', 'images/players/julius_randle.png'),
('Shai Gilgeous-Alexander', 'Oklahoma City Thunder', 'Guard', 'images/players/shai_gilgeous_alexander.png'),
('Paolo Banchero', 'Orlando Magic', 'Forward', 'images/players/paolo_banchero.png'),
('Joel Embiid', 'Philadelphia 76ers', 'Center', 'images/players/joel_embiid.png'),
('Devin Booker', 'Phoenix Suns', 'Guard', 'images/players/devin_booker.png'),
('Damian Lillard', 'Portland Trail Blazers', 'Guard', 'images/players/damian_lillard.png'),
('DeAaron Fox', 'Sacramento Kings', 'Guard', 'images/players/deaaron_fox.png'),
('Victor Wembanyama', 'San Antonio Spurs', 'Center', 'images/players/victor_wembanyama.png'),
('Scottie Barnes', 'Toronto Raptors', 'Forward', 'images/players/scottie_barnes.png'),
('Lauri Markkanen', 'Utah Jazz', 'Forward', 'images/players/lauri_markkanen.png'),
('Bradley Beal', 'Washington Wizards', 'Guard', 'images/players/bradley_beal.png');