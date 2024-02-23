Require Import List.
Import ListNotations.

Inductive estPair : nat -> Prop :=
  | pair_0 : estPair 0
  | pair_SS : forall n : nat, estPair n -> estPair (S (S n)).

Lemma pair_4 : estPair 4.
Proof.
  apply (pair_SS 2).
  apply (pair_SS 0).
  apply pair_0.
Qed.

(* Inductive is_perm : list nat -> list nat -> Prop :=
  | is_perm_easy : forall hd : nat, is_perm (hd::nil) (hd::nil)
  | is_perm_hard : forall l l' : list nat, exists n : nat, is_perm (n::l) (l'++(n::nil)). *)

Inductive is_perm : list nat -> list nat -> Prop :=
| is_perm_refl : forall l, is_perm l l
| is_perm_cons : forall (l1 l2 : list nat) (e: nat), is_perm l1 l2 -> is_perm (e::l1) (e::l2)
| is_perm_app : forall (l1 l2 : list nat) (e :nat), is_perm l1 l2 -> is_perm (e::l1) (l2++[e])
| is_perm_sym : forall l1 l2, is_perm l1 l2 -> is_perm l2 l1
| is_perm_trans : forall l1 l2 l3, is_perm l1 l2 -> is_perm l2 l3 -> is_perm l1 l3.

Lemma exo4_q2 : is_perm [1;2;3] [3;2;1].
Proof.
  apply (is_perm_app [2;3] [3;2] 1).
  apply (is_perm_app [3] [3]).
  apply (is_perm_refl).
Qed.


Require Import Lia.

Inductive is_sorted : list nat -> Prop :=
| is_sorted_0 : is_sorted [] (* la liste vide est triée *)
| is_sorted_1 : forall (n : nat), is_sorted [n] (* une liste de taille 1 est triée *)
| is_sorted_S : forall (l : list nat) (x y : nat), is_sorted(y::l) -> x<=y -> is_sorted(x::y::l).
(* Si une liste est triée, alors, en ajoutant en tête un élément plus petit, la liste reste triée *)

Lemma un_deux_trois_is_sorted : is_sorted[1;2;3].
Proof.
  apply is_sorted_S.
  - apply is_sorted_S.
  -- apply is_sorted_1.
  -- lia.
  - lia.
Qed.
