-- User info
-- Index relation: user; index attribute: email
-- Type: hash; cardinality: high (unique key); clustering: no
CREATE INDEX email_user ON User USING hash("e-mail")

-- Project info
-- Index relation: Project; index attribute: id
-- Type: hash; cardinality: high (unique key); clustering: no
CREATE INDEX id_project ON Project USING hash(id)

-- Projects of a given user
-- Index relation: Project_team; index attribute: id_user
-- Type: hash; cardinality: medium; clustering: yes
CREATE INDEX user_project ON Project_team USING hash(id_user)

-- Boards of a given project
-- Index relation: Board; index attribute: id_project
-- Type: hash; cardinality: medium; clustering: yes
CREATE INDEX project_boards ON Board USING hash(id_project)

-- Messages by date and project
-- Index relation: message; index attribute: date, project
-- Index type: B-tree; cardinality: medium; clustering: yes
CREATE INDEX message_date ON Message USING btree(date, id_project)

-- Search projects
-- Index relation: project; index attribute: title
-- Type: GiST; clustering: no
CREATE INDEX search_project ON Project USING GIST(title)

-- Search users
-- Index relation: user; index attribute: username
-- Type:GiST; clustering: no
CREATE INDEX search_user ON User USING GIST(username)